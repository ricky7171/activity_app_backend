<?php
namespace App\Services\Implementations;

use App\Services\Contracts\MediaGalleryServiceContract;
use App\Repositories\Contracts\MediaGalleryRepositoryContract as MediaGalleryRepo;
use App\Exceptions\StoreDataFailedException;
use Storage;

class MediaGalleryServiceImplementation implements MediaGalleryServiceContract {
    protected $mediaGalleryRepo;
    public function __construct(MediaGalleryRepo $mediaGalleryRepo)
    {
        $this->mediaGalleryRepo = $mediaGalleryRepo;
    }

    public function get() {
        return $this->mediaGalleryRepo->allOrder('id', 'desc');
    }

    public function store($input) {
        if($input['type'] !== 'youtube') {
            $input['value'] = $input['file']->store('media-galleries', 'public');
        }
        
        switch ($input['type']) {
            case 'image':
                $input['thumbnail'] = $input['value'];
                break;
            case 'youtube':
                // example url = https://www.youtube.com/watch?v=SMKPKGW083c
                $youtube_id = substr($input['value'], strpos($input['value'], '?v=')+3);
                $input['thumbnail'] = "https://img.youtube.com/vi/{$youtube_id}/hqdefault.jpg";
                break;
            case 'video':
                $input['thumbnail'] = $input['thumbnail']->store('media-galleries', 'public');
                break;
        }
        
        return $this->mediaGalleryRepo->store($input);
    }

    public function update($input, $id) {
        return $this->mediaGalleryRepo->update($input, $id);
    }

    public function delete($id) {
        return $this->mediaGalleryRepo->delete($id);
    }

    public function search($fields) {
        return $this->mediaGalleryRepo->search($fields);
    }

    public function getUsingMonthYear($month, $year) {
        return $this->mediaGalleryRepo->getUsingMonthYear($month, $year);
    }

    public function changePosition($new_position) {
        return $this->mediaGalleryRepo->changePosition($new_position);
    }
}