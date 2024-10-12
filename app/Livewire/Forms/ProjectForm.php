<?php

    namespace App\Livewire\Forms;

    use App\Models\Genre;
    use App\Models\Project;
    use App\Models\ProjectGenreConnection;
    use App\Models\ProjectLinkReferenceConnection;
    use App\Models\ProjectPlatformConnection;
    use App\Models\ProjectTypeConnection;
    use App\Repositories\ImageRepository;
    use Illuminate\Support\Collection;
    use Livewire\Form;

    class ProjectForm extends Form {

        public ?Project $project;

        public string $name = '';
        public string $description = '';
        public ?\DateTime $release_date = null;
        public int $heading_img_id = 0;
        public int $publisher_id = 0;

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

            $saved_image = ImageRepository::uploadImage($this->getPropertyValue('heading_img'));

            $this->heading_img_id = $saved_image->id;

            $this->publisher_id = $this->getPropertyValue('publisher_id');

            // TODO: implement saving of project type, platforms, linkReferences and genres

            $this->project = Project::factory()->create($this->getAttributes());

            $this->reset();
        }

        private function getAttributes(): array {
            return $this->only(['name', 'description', 'release_date', 'heading_img_id', 'publisher_id']);
        }

    }
