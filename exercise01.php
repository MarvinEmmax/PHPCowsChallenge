<?php

# =============================================================================
# PHP :: EXERCISE SOLUTION BY: MARVIN EMMAX DEVELOPER. VENEZUELA. # 001
# Date: 15/10/2022
# PHP 7.4/8.0
# =============================================================================

class ProductionCalculator {

    
    //=================================================================================================
    //  Variables and Properties
    //=================================================================================================


    public $file_name = '';             // File name JSON Format (string)

    
    public $data;                       // Data loaded from JSON file (array)

    
    public $max_truck_weight;           //  Max Weight Truck Support (Loaded from JSON data) (int)

    
    public $best_selection = array();   //  Result with best cow selection for transport y production (array)

 
    //=================================================================================================
    // 
    //=================================================================================================

    protected function __orderRListMaxProduction($data1, $data2) {

    $arg1 = $data1['total_production'];
    $arg2 = $data2['total_production'];

    if ($arg1 == $arg2) {

        return 0;

    }

    return ($arg1 > $arg2) ? -1 : 1;

    }


    //=================================================================================================
    // 
    //=================================================================================================

    protected function __orderMaxProduction($data1, $data2) {

    $arg1 = $data1->production;
    $arg2 = $data2->production;

    if ($arg1 == $arg2) {

        return 0;

    }

    return ($arg1 > $arg2) ? -1 : 1;

   }

    //=================================================================================================
    // Load Data from File JSON
    //=================================================================================================

    public function loadData() {

     if (!empty($_SERVER['argv'][1])) {

      $this->file_name = $_SERVER['argv'][1];

      }

        if (file_exists('./'.$this->file_name)) {

            $this->data = json_decode(file_get_contents('./'.$this->file_name), false);
            
            if($this->data == false) {
             
             die('El archivo es inválido!. Asegúrese que se encuentre en formato JSON.');

            }

          $this->max_truck_weight = $this->data->truck_weight;

        
        } else {

            die('No se encuentra el archivo de datos');

        }

    }

    //=================================================================================================
    // Order Object array by Production (Desc)
    //=================================================================================================

    public function orderData() {

        $data = $this->data->cows;
        
        foreach ($data as $key => $value) {
        
        $ordered[] = $value; 

        }

        usort($ordered, [ProductionCalculator::class,"__orderMaxProduction"]);

         return $ordered;

    }

    //=================================================================================================
    // Generate many options for Truck Load and Milk Production
    //=================================================================================================

    public function getRecursiveList($dataList) {

        $count = false;
        $size = sizeof($dataList);
        $data = $dataList;
        $result = array();

        for ($i = 0; $i < $size - 1 ; $i++) {

            $total_weight = 0;
            $total_production = 0;
            $cows = array();

            for ($j = 0; $j < $size; $j++) {

                if (($total_weight + $data[$j]->weight) <= $this->data->truck_weight) {

                    $cows[] = $data[$j]->cow;
                    $total_weight += $data[$j]->weight;
                    $total_production += $data[$j]->production;

                }

            }

            $result[] = array('cows' => $cows, 'total_weight' => $total_weight, 'total_production' => $total_production);

            array_shift($data);
            array_push($data, $dataList[$i]);

        }

        
        
        foreach ($result as $key => $value) {
        
        array_multisort($result[$key]['cows'], SORT_ASC);    
        
        }
        
        
         usort($result, [ProductionCalculator::class,"__orderRListMaxProduction"]);
        
         $this->best_selection = $result[0];

        return $result;

    }

}

//=================================================================================================
// Init Program Class
//=================================================================================================

$calculator = new ProductionCalculator();
$calculator->file_name = 'cows.json';    
$calculator->loadData();
$ordered = $calculator->orderData();
$result  = $calculator->getRecursiveList($ordered);

printf("\r\n");
printf("**********************************************"); 
printf("\r\n");
printf("CALCULO DE TRANSPORTE OPTIMO DE VACAS. \r\n"); 
printf("CREADO POR: MARVIN EMMAX DEVELOPER. VENEZUELA.\r\n");
printf("**********************************************"); 
printf("\r\n");
printf("Peso máximo del camión: %d Kgs",$calculator->max_truck_weight);
printf("\r\n");
printf("Cantidad Total de vacas: %d", sizeof($calculator->data->cows));
printf("\r\n");
printf("=================================================================="); 
printf("\r\n");
printf("La mejor seleccion de vacas que puede cargar su camión es: ");
printf("\r\n");

foreach($calculator->best_selection['cows'] as $key => $value) {

    printf("[%d],", $value);

}


printf("\r\n");
printf("\r\n");
printf("Eso le permite maximizar la producción a [%d litros] de leche.", $result[0]['total_production']);
printf("\r\n");
printf("\r\n");
printf("Con un peso total de [%d Kg].", $result[0]['total_weight']);
printf("\r\n");
printf("==================================================================");
printf("\r\n\r\nOtras opciones son:\r\n");


for ($i = 1; $i < sizeof($result); $i++) {

    printf("\r\n\r\n Las vacas: ");

    foreach($result[$i]['cows'] as $key => $value) {

        printf("%d,", $value);

    }

    printf("\r\n Con producción de %d litros de leche.", $result[$i]['total_production']);
    printf("\r\n Y con un peso total de %d Kg.", $result[$i]['total_weight']);

}

printf("\r\n");
printf("\r\n");
?>