<?php
class DataSetTest {

    function  readCsv() {
// defining CSV data here as per document 
        $dataset1 = <<<DS1
NAME,LEG_LENGTH,DIET
Hadrosaurus,1.2,herbivore
Struthiomimus,0.92,omnivore
Velociraptor,1.0,carnivore
Euoplocephalus,1.6,herbivore
Stegosaurus,1.40,herbivore
Tyrannosaurus Rex,2.5,carnivore
DS1;

        $dataset2 = <<<DS2
NAME,STRIDE_LENGTH,STANCE
Euoplocephalus,1.87,quadrupedal
Stegosaurus,1.90,quadrupedal
Tyrannosaurus Rex,5.76,bipedal
Hadrosaurus,1.4,bipedal
Struthiomimus,1.34,bipedal
Velociraptor,2.72,bipedal
DS2;

        // reading the CSV data to array
        $array1 = preg_split("/\r\n|\n|\r/", $dataset1);
        $array2 = preg_split("/\r\n|\n|\r/", $dataset2);

        $dinosaurs1 = array();
        $dinosaurs2 = array();
        // adding the elements to array by splitting with comma.
        for($num=1;$num<count($array1); $num++)
        {
            $str1=explode(',',$array1[$num]);
            $dinosaurs1[] = array($str1[0], $str1[1], $str1[2]);
            $str2=explode(',',$array2[$num]);
            if ($str2[2] == "bipedal")
                $dinosaurs2[] = array($str2[0], $str2[1], $str2[2]);
        }
       // print_r($dinosaurs1);
       // print_r($dinosaurs2);
        $this->calculateSpeed($dinosaurs1, $dinosaurs2);
    }

    // calculating the speed the speed of dinosaur
    private function calculateSpeed(array $dinosaurs1, array $dinosaurs2)
    {
        $dinosaurSort = array();
        for ($i = 0; $i < count($dinosaurs2); ++$i) {
            $innerDinosaur2 =  $dinosaurs2[$i];
            for ($j = 0; $j < count($dinosaurs1); ++$j) {
                $innerDinosaur1 =  $dinosaurs1[$j];
                //print_r($innerDinosaur2[2]);
                if ($innerDinosaur2[0] == $innerDinosaur1[0] && $innerDinosaur2[2] == 'bipedal') {
                    $speed = (($innerDinosaur2[1] / $innerDinosaur1[1]) - 1) * SQRT($innerDinosaur1[1] * 9.8);
                    $dinosaurSort[] = array("Name"=> $innerDinosaur1[0], "Speed" => $speed);
                    break;
                }

            }
        }


        $speed = array();
        foreach ($dinosaurSort as $key => $row)
        {
            $speed[$key] = $row['Speed'];
        }
        // sorting the dinosaurs in desc order
        array_multisort($speed, SORT_DESC, $dinosaurSort);
        //print_r($dinosaurSort); //this can be used to validate the speed and name.
        $names = array();
        foreach ($dinosaurSort as $key => $row)
        {
            $names[$key] = $row['Name'];
        }
        print_r($names);

    }
}

$test = new DataSetTest();
$test -> readCsv();
