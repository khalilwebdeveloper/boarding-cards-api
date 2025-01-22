<?php

namespace App;

class BoardingPass {
    private $boardingPasses = [];

    public function __construct(array $boardingPasses) {
        $this->boardingPasses = $boardingPasses;
    }

    public function sortBoardingPasses() {
        $fromIndex = [];
        $toIndex = [];

        foreach ($this->boardingPasses as $card) {
            $fromIndex[$card['from']] = $card;
            $toIndex[$card['to']] = $card;
        }

        $start = null;
        foreach ($fromIndex as $from => $card) {
            if (!isset($toIndex[$from])) {
                $start = $from;
                break;
            }
        }

        $sortedPasses = [];
        $currentLocation = $start;

        while ($currentLocation) {
            if (isset($fromIndex[$currentLocation])) {
                $currentCard = $fromIndex[$currentLocation];
                $sortedPasses[] = $currentCard;
                $currentLocation = $currentCard['to'];
            } else {
                $currentLocation = null;
            }
        }

        return $sortedPasses;
    }

    public function getJourneyDescription() {
        $sortedPasses = $this->sortBoardingPasses();
        $descriptions = [];

        foreach ($sortedPasses as $card) {
            $description = "Prendre le " . $card['transport'];

            if (!empty($card['details'])) {
                $description .= " " . $card['details'];
            }

            $description .= " de " . $card['from'] . " à " . $card['to'] . ".";

            if (!empty($card['seat'])) {
                $description .= " Asseyez-vous au siège " . $card['seat'] . ".";
            } else {
                $description .= " Aucune attribution de siège.";
            }

            if (!empty($card['gate'])) {
                $description .= " Porte " . $card['gate'] . ".";
            }

            if (!empty($card['baggage'])) {
                $description .= " " . $card['baggage'];
            }

            $descriptions[] = $description;
        }

        $descriptions[] = "Vous êtes arrivé à votre destination finale.";

        return implode("\n", $descriptions);
    }
}
