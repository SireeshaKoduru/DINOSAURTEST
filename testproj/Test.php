<?php
class Test {

    function  readCsv() {

        if (($openDataset1 = fopen("dataset1.csv", "r")) !== FALSE)
        {
            $dinosaurs1 = array();
            while (($data = fgetcsv($openDataset1, 1000, ",")) !== FALSE)
            {
                $dinosaurs1[] = array($data[0], $data[1], $data[2]);
            }
            fclose($openDataset1);
        }

        if (($openDataset2 = fopen("dataset2.csv", "r")) !== FALSE)
        {
            $dinosaurs2 = array();
            while (($dataset = fgetcsv($openDataset2, 1000, ",")) !== FALSE)
            {
                if ($dataset[2] == "bipedal")
                $dinosaurs2[] = array($dataset[0], $dataset[1], $dataset[2]);
            }

            fclose($openDataset2);
        }
            $this->calculateSpeed($dinosaurs1, $dinosaurs2);


    }

    private function calculateSpeed(array $dinosaurs1, array $dinosaurs2)
    {
        $dinosaurSort = array();
        for ($i = 0; $i < count($dinosaurs2); ++$i) {
            $innerDinosaur2 =  $dinosaurs2[$i];
            for ($j = 0; $j < count($dinosaurs1); ++$j) {
                $innerDinosaur1 =  $dinosaurs1[$j];
                if ($innerDinosaur2[0] == $innerDinosaur1[0]) {

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

$test = new Test();
$test -> readCsv();
