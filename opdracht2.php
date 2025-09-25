<?php
namespace HouseSystem;

// Room klasse - representeert een enkele kamer met afmetingen
class Room
{
    private string $name;
    private float $length;
    private float $width;
    private float $height;
    private float $volume;

    // Constructor om kamer eigenschappen te initialiseren
    public function __construct(string $name, float $length, float $width, float $height)
    {
        $this->setName($name);
        $this->setDimensions($length, $width, $height);
    }

    // Setter voor kamer naam
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // Setter voor kamer afmetingen en bereken volume
    public function setDimensions(float $length, float $width, float $height): void
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        // Bereken en rond volume af op 2 decimalen
        $this->volume = round($length * $width * $height, 2);
    }

    // Getter voor kamer naam
    public function getName(): string
    {
        return $this->name;
    }

    // Getter voor kamer lengte
    public function getLength(): float
    {
        return $this->length;
    }

    // Getter voor kamer breedte
    public function getWidth(): float
    {
        return $this->width;
    }

    // Getter voor kamer hoogte
    public function getHeight(): float
    {
        return $this->height;
    }

    // Getter voor kamer volume
    public function getVolume(): float
    {
        return $this->volume;
    }
}

// House klasse - bevat meerdere kamers en berekent totaal volume en prijs
class House
{
    private string $address;
    private array $rooms;
    private float $pricePerCubicMeter;

    // Constructor om huis eigenschappen te initialiseren
    public function __construct(string $address, float $pricePerCubicMeter = 500.0)
    {
        $this->setAddress($address);
        $this->setPricePerCubicMeter($pricePerCubicMeter);
        $this->rooms = [];
    }

    // Setter voor huis adres
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    // Setter voor prijs per kubieke meter
    public function setPricePerCubicMeter(float $price): void
    {
        $this->pricePerCubicMeter = $price;
    }

    // Methode om een kamer aan het huis toe te voegen
    public function addRoom(Room $room): void
    {
        $this->rooms[] = $room;
    }

    // Methode om alle kamers op te halen
    public function getRooms(): array
    {
        return $this->rooms;
    }

    // Getter voor huis adres
    public function getAddress(): string
    {
        return $this->address;
    }

    // Getter voor prijs per kubieke meter
    public function getPricePerCubicMeter(): float
    {
        return $this->pricePerCubicMeter;
    }

    // Bereken totaal volume van alle kamers in het huis
    public function getTotalVolume(): float
    {
        $totalVolume = 0.0;
        
        // Loop door alle kamers heen en tel hun volumes op
        foreach ($this->rooms as $room) {
            $totalVolume += $room->getVolume();
        }
        
        return round($totalVolume, 2);
    }

    // Bereken totale prijs van het huis gebaseerd op volume
    public function getTotalPrice(): float
    {
        return round($this->getTotalVolume() * $this->pricePerCubicMeter, 2);
    }

    // Methode om alle kamer informatie weer te geven
    public function displayRoomsInfo(): void
    {
        echo "<h3>Rooms in " . $this->getAddress() . ":</h3>\n";
        echo "<ul>\n";
        
        foreach ($this->rooms as $room) {
            echo "<li>";
            echo $room->getName() . " - ";
            echo "Dimensions: " . $room->getLength() . "m x " . $room->getWidth() . "m x " . $room->getHeight() . "m - ";
            echo "Volume: " . $room->getVolume() . " m³";
            echo "</li>\n";
        }
        
        echo "</ul>\n";
    }
}

// Huis object aanmaken
$myHouse = new House("Kerkstraat 42, Amsterdam", 600.0);

// Kamer objecten aanmaken
$livingRoom = new Room("Living Room", 5.5, 4.2, 2.8);
$kitchen = new Room("Kitchen", 3.8, 3.0, 2.8);
$bedroom1 = new Room("Master Bedroom", 4.5, 3.5, 2.8);
$bedroom2 = new Room("Guest Bedroom", 3.2, 3.0, 2.8);
$bathroom = new Room("Bathroom", 2.5, 2.0, 2.8);

// Kamers toevoegen aan het huis
$myHouse->addRoom($livingRoom);
$myHouse->addRoom($kitchen);
$myHouse->addRoom($bedroom1);
$myHouse->addRoom($bedroom2);
$myHouse->addRoom($bathroom);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Volume and Price Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        h2, h3 {
            color: #555;
        }
        .house-info {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .summary {
            background-color: #f1f8e9;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #fafafa;
            margin: 5px 0;
            padding: 10px;
            border-left: 4px solid #007bff;
            border-radius: 3px;
        }
        .price {
            font-size: 1.2em;
            font-weight: bold;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏠 House Volume and Price Calculator</h1>
        
        <div class="house-info">
            <h2>House Information</h2>
            <p><strong>Address:</strong> <?php echo $myHouse->getAddress(); ?></p>
            <p><strong>Price per m³:</strong> €<?php echo $myHouse->getPricePerCubicMeter(); ?></p>
        </div>

        <?php $myHouse->displayRoomsInfo(); ?>

        <div class="summary">
            <h2>📊 Summary</h2>
            <p><strong>Total Volume:</strong> <?php echo $myHouse->getTotalVolume(); ?> m³</p>
            <p class="price"><strong>Total House Price:</strong> €<?php echo number_format($myHouse->getTotalPrice(), 2); ?></p>
        </div>

        <h3>🔍 Individual Room Details</h3>
        <?php
        foreach ($myHouse->getRooms() as $room) {
            echo "<div style='margin: 10px 0; padding: 10px; background-color: #f8f9fa; border-radius: 5px;'>";
            echo "<strong>" . $room->getName() . "</strong><br>";
            echo "Length: " . $room->getLength() . "m | ";
            echo "Width: " . $room->getWidth() . "m | ";
            echo "Height: " . $room->getHeight() . "m<br>";
            echo "<span style='color: #007bff;'>Volume: " . $room->getVolume() . " m³</span>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>