<?php
    require_once(__DIR__.'/Calculadora.php');
    use \PHPUnit\Framework\TestCase;
    class CalculadoraTest extends TestCase{
        public function sumarProveedor(){
            return [
                'Caso 1' => [-1, -1, -2],
                'Caso 2' => [0, 0, 0],
                'Caso 3' => [0, -1, -1],
                'Caso 4' => [-1, 0, -1]
            ];
        }
        public function restarProveedor(){
            return [
                'Caso 1' => [-1, -1, 0],
                'Caso 2' => [0, 0, 0],
                'Caso 3' => [0, -1, 1],
                'Caso 4' => [-1, 0, -1]
            ];
        }
        public function multiplicarProveedor(){
            return [
                'Caso 1' => [-1, -1, 1],
                'Caso 2' => [0, 0, 0],
                'Caso 3' => [0, -1, 0],
                'Caso 4' => [-1, 0, 0]
            ];
        }
        public function dividirProveedor(){
            return [
                'Caso 1' => [-1, -1, 1, 0],
                'Caso 2' => [0, 0, "Exception",""],
                'Caso 3' => [0, -1, 0, 0],
                'Caso 4' => [-1, 0, "Exception", ""],
                'Caso 5' => [1, 3, 0.33, 0.01]
            ];
        }
        /**
        * @dataProvider sumarProveedor() 
        */
        public function testSumar($n1, $n2, $res){
            $calculadora = new Calculadora();
            /* $this->assertEquals(6, $calculadora->sumar(3,3)); */
            $this->assertSame($res, $calculadora->sumar($n1,$n2));
        }

        /**
        * @dataProvider restarProveedor() 
        */
        public function testRestar($n1, $n2, $res){
            $calculadora = new Calculadora();
            $this->assertEquals($res, $calculadora->restar($n1,$n2));
        }

        /**
        * @dataProvider multiplicarProveedor() 
        */
        public function testMultiplicar($n1, $n2, $res){
            $calculadora = new Calculadora();
            $this->assertEquals($res, $calculadora->multiplicar($n1,$n2));
        }


        /**
        * @dataProvider dividirProveedor() 
        */
        public function testDividir($n1, $n2, $res, $delta){
            $calculadora = new Calculadora();
            if($n2 != 0){
                $this->assertEqualsWithDelta($res, $calculadora->dividir($n1,$n2), $delta);
            }else{
                $this->expectException("Exception");
                $calculadora->dividir($n1, $n2);
            }
        }



        public function testGenerarArreglo(){
            $calculadora = new Calculadora();
            /* $this->assertContains(5, $calculadora->generarArreglo()); */
            /* $this->assertCount(8, $calculadora->generarArreglo()); */
            $this->assertNotEmpty($calculadora->generarArreglo());
        }

    }
?>