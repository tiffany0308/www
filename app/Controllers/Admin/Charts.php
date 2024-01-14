<?php

namespace App\Controllers\Admin;

use Config\Services;
use App\Controllers\BaseController;
use App\Models\EventModel;

class Charts extends BaseController
{
    public function index()
    {
        $eventModel = new EventModel();

        $events = $eventModel->findAll();

        $ratingsByTag = []; 
        $tagCounts = []; 

        foreach ($events as $event) {
            if ($event->tags !== null) {
                $tags = explode(',', $event->tags); 

                foreach ($tags as $tag) {
                    $ratingsByTag[$tag]['sum'] = isset($ratingsByTag[$tag]['sum']) ? $ratingsByTag[$tag]['sum'] + $event->average_rating : $event->average_rating; // Access 'average_rating' directly as object property
                    $ratingsByTag[$tag]['count'] = isset($ratingsByTag[$tag]['count']) ? $ratingsByTag[$tag]['count'] + 1 : 1;

                    $tagCounts[$tag] = isset($tagCounts[$tag]) ? $tagCounts[$tag] + 1 : 1;
                }
            }
        }

        foreach ($ratingsByTag as $tag => $data) {
            $averageRating = $data['sum'] / $data['count'];
            $ratingsByTag[$tag]['average'] = $averageRating;
        }

        $topEvents = array_slice($events, 0, 5);

        $tagLabels = array_keys($tagCounts);
        $tagCountsData = array_values($tagCounts);

        $tagLabelsRatings = array_keys($ratingsByTag);
        $tagAverageRatings = array_column($ratingsByTag, 'average');

        $eventTitles = array_column($topEvents, 'title');
        $eventRatings = array_column($topEvents, 'average_rating');

        $data['tagDistribution'] = json_encode([
            'labels' => $tagLabels,
            'data' => $tagCountsData,
        ]);

        $data['averageRatingsByTag'] = json_encode([
            'labels' => $tagLabelsRatings,
            'data' => $tagAverageRatings,
        ]);

        $data['topEvents'] = json_encode([
            'labels' => $eventTitles,
            'data' => $eventRatings,
        ]);

        return view('admin/charts/show', $data);
    }
}