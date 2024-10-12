<?php

    namespace App\Livewire;

    use App\Livewire\Forms\PublisherForm;
    use App\Models\Publisher;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Foundation\Application;
    use Livewire\Component;

    class UpdatePublisher extends Component {
        public PublisherForm $form;

        public function mount(Publisher $publisher): void {
            $this->form->load($publisher);
        }

        public function save(): null {
            $this->form->update();

            $this->redirect('dashboard#publisher');
            return null;
        }

        public function render(): Application|Factory|View|\Illuminate\View\View {
            return view('livewire.form-publisher');
        }
    }
