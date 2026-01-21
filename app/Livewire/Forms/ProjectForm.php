<?php

    namespace App\Livewire\Forms;

    use App\Models\Genre;
    use App\Models\Project;
    use App\Models\ProjectGenreConnection;
    use App\Models\ProjectLinkReferenceConnection;
    use App\Models\ProjectPlatformConnection;
    use App\Models\ProjectTypeConnection;
    use Illuminate\Support\Collection;
    use Livewire\Form;

    class ProjectForm extends Form {

        public ?Project $project;

        public string $name = '';
        public string $description = '';
        public ?\DateTime $release_date = null;
        public int $heading_img_id = 0;
        public int $publisher_id = 0;

        /**
         * Holds selected image IDs from the image picker (multi-select).
         * The first ID (if present) will be used as heading_img_id for backward compatibility.
         */
        public array $image_ids = [];

        public ?Collection $projectTypes = null;
        public ?Collection $platforms = null;
        public ?Collection $linkReferences = null;
        public ?Collection $genres = null;

        public function load( Project $project ): void {

            $this->project = $project;

            $this->name        = $project->name;
            $this->description = $project->description;

            $this->release_date = $project->release_date;

            $this->heading_img_id = $project->heading_img_id;

            $this->publisher_id = $project->publisher_id;

            $this->projectTypes   = ProjectTypeConnection::getByProject( $project->id );
            $this->platforms      = ProjectPlatformConnection::getByProject( $project->id );
            $this->linkReferences = ProjectLinkReferenceConnection::getByProject( $project->id );
            $this->genres         = ProjectGenreConnection::getByProject( $project->id );
        }

        public function update() {
            // TODO: implement
        }

        public function store(): void {
            $this->validate();

            $this->name = $this->getPropertyValue('name');
            $this->description = $this->getPropertyValue('description');
            $this->release_date = new \DateTime($this->getPropertyValue('release_date'));

            // Use the first selected image as the heading image if available.
            // This replaces the previous direct-upload approach with SelectImage multi-select.
            if (!empty($this->image_ids)) {
                $firstId = (int) ($this->image_ids[0] ?? 0);
                $this->heading_img_id = $firstId > 0 ? $firstId : 0;
            }

            $this->publisher_id = $this->getPropertyValue('publisher_id');

            // TODO: implement saving of project type, platforms, linkReferences and genres

            $this->project = Project::factory()->create($this->getAttributes());

            $this->reset();
        }

        /**
         * Event handler for single selection compatibility.
         */
        public function setSelectedImage(int $id): void
        {
            $id = (int) $id;
            $this->image_ids = $id > 0 ? [ $id ] : [];
            $this->heading_img_id = $id > 0 ? $id : 0;
        }

        /**
         * Event handler to receive multiple selected image IDs from the SelectImage modal.
         *
         * @param array<int,int|string> $ids
         */
        public function setSelectedImages(array $ids): void
        {
            // Normalize to unique positive integers
            $normalized = array_values(array_unique(array_map(static fn($v) => (int) $v, $ids)));
            $normalized = array_values(array_filter($normalized, static fn($v) => $v > 0));
            $this->image_ids = $normalized;

            // Maintain heading_img_id from the first selection if present
            $this->heading_img_id = $normalized[0] ?? 0;
        }

        private function getAttributes(): array {
            return $this->only(['name', 'description', 'release_date', 'heading_img_id', 'publisher_id']);
        }

    }
