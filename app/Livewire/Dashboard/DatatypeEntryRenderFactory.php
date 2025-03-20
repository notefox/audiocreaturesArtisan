<?php

	namespace App\Livewire\Dashboard;

	use App\Livewire\Dashboard\DatatypeTemplates\GridImageEntries;
    use App\Livewire\Dashboard\DatatypeTemplates\ListDatatypeEntries;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Foundation\Application;

    use Illuminate\Support\Collection;
    use Livewire\Component;

    /**
     * @see GridImageEntries
     * @see ListDatatypeEntries
     */
    class DatatypeEntryRenderFactory extends Component {
        public string $datatype;
        public Collection $entries;
        public string $template;

        public string $defaultTemplate = 'livewire.list-datatype-entries';

        public function mount($datatype, $entries, $template): void {
            $this->datatype = $datatype;
            $this->entries = $entries;
            $this->template = $template;
        }

        public function render(): Factory|View|Application {
            if( ! view()->exists($this->template) ) {
                return view($this->defaultTemplate, ['id' => $this->datatype]);
            }

            return view($this->template, ['id' => $this->datatype]);
        }
	}
