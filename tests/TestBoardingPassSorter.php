<?php

// Include the BoardingPass class
require_once '../src/BoardingPass.php';

use App\BoardingPass;

// Test the sorting and description generation
$boardingPasses = [
    [
        'from' => 'Madrid',
        'to' => 'Barcelona',
        'transport' => 'train',
        'details' => '78A',
        'seat' => '45B'
    ],
    [
        'from' => 'Stockholm',
        'to' => 'New York JFK',
        'transport' => 'flight',
        'details' => 'SK22',
        'seat' => '7B',
        'gate' => '22',
        'baggage' => 'Baggage will be automatically transferred.'
    ],
    [
        'from' => 'Barcelona',
        'to' => 'Girona Airport',
        'transport' => 'bus',
        'seat' => null
    ],
    [
        'from' => 'Girona Airport',
        'to' => 'Stockholm',
        'transport' => 'flight',
        'details' => 'SK455',
        'seat' => '3A',
        'gate' => '45B',
        'baggage' => 'Baggage drop at counter 344.'
    ]
];

// Create an instance of BoardingPass
$sorter = new BoardingPass($boardingPasses);

// Run the journey description test
echo "Test 1: Journey Description\n";
echo "===========================\n";
echo $sorter->getJourneyDescription();

echo '<br><br>';
// Run the sorting test
echo "\nTest 2: Sorted Boarding Passes\n";
echo "=============================\n";
$sortedPasses = $sorter->sortBoardingPasses();
foreach ($sortedPasses as $pass) {
    echo "From: " . $pass['from'] . " to " . $pass['to'] . "\n";
    echo "Transport: " . $pass['transport'] . "\n";
    echo "Seat: " . (isset($pass['seat']) ? $pass['seat'] : 'No seat assigned') . "\n";
    echo "=============================\n";
}
?>
