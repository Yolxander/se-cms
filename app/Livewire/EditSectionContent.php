<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Section;
use App\Models\Content;
use App\Models\Image;

class EditSectionContent extends Component
{
    public $section;
    public $contents = [];
    public $errorMessages = [];

    // Validation rules
    protected $rules = [
        'contents.*.value' => 'nullable',
        'contents.*.key' => 'required|string',
        'contents.*.type' => 'required|string',
    ];

    // Mount method to initialize data
    public function mount($sectionId)
    {
        try {
            $this->section = Section::with('content')->findOrFail($sectionId);
            $this->contents = $this->section->content->toArray();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load section data: ' . $e->getMessage());
        }
    }

    // Update section and content
    public function updateSection()
    {
        $this->errorMessages = [];

        try {
            $this->validate();

            // Update section
            $this->section->update([
                'name' => $this->section['name'],
                'order' => $this->section['order'],
                'component_name' => $this->section['component_name'],
                'page_id' => $this->section['page_id'],
            ]);

            // Update content
            foreach ($this->contents as $contentData) {
                $content = Content::find($contentData['id']);
                if ($content) {
                    if ($content->type === 'gallery') {
                        continue; // Skip updating gallery type content
                    }

                    $value = $contentData['value'] ?? null;

                    // Handle content type-specific logic
                    if ($content->type === 'list') {
                        $value = json_encode($value ?? []);
                    } elseif ($content->type === 'json') {
                        $value = json_encode($value ?? (object)[]);
                    }

                    // Perform the update
                    $content->update([
                        'key' => $contentData['key'],
                        'type' => $contentData['type'],
                        'value' => $value,
                    ]);
                }
            }

            session()->flash('message', 'Section updated successfully.');
        } catch (\Exception $e) {
            $this->errorMessages[] = 'Error updating section: ' . $e->getMessage();
        }
    }

    // Delete section and related data
    public function deleteSection()
    {
        try {
            // Delete related content
            $this->section->content()->delete();

            // Delete related images
            $this->section->images()->delete();

            // Delete the section itself
            $this->section->delete();

            session()->flash('message', 'Section deleted successfully.');
            return redirect()->route('sections.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting section: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edit-section-content');
    }
}
