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
        
        public function testCapturarEntradasPermutacion(){

            $stub = $this->createMock('Calculadora');
            $stub->method('capturarEntradasPermutacion')->willReturn(array(5,3));

            $this->assertSame(array(5,3), $stub->capturarEntradasPermutacion());
        }

        public function testCalcularPermutacion(){
            $mock = $this->getMockBuilder('Calculadora')->onlyMethods(array('calcularFactorial'))->getMock();

            $mock->expects($this->exactly(2))->method('calcularFactorial')->will($this->onConsecutiveCalls(120, 6));

            $this->assertSame(20, $mock->calcularPermutacion(5,2));
        }

        public function testComprobarLlamada(){
            $mock = $this->getMockBuilder('Calculadora')->onlyMethods(array('calcularFactorial'))->getMock();

            /* $mock->expects($this->exactly(2))->method('calcularFactorial')->withConsecutive([5],[3]);

            $mock->calcularFactorial(5);
            $mock->calcularFactorial(3); */

            /* $mock->expects($this->once())->method('calcularFactorial')->with(5)->will($this->returnValue(120));
            $res = $mock->calcularFactorial(5);
            $this->assertEquals(120, $res); */
            /* $mock->calcularFactorial(3); */
            /* $this->assertEquals(110, $res); */

            $mock->expects($this->exactly(2))->method('calcularFactorial')->withConsecutive([5],[3])->will($this->onConsecutiveCalls(120,6));
            $this->assertEquals(120, $mock->calcularFactorial(5));
            $this->assertEquals(6, $mock->calcularFactorial(3));

        }

    }
?>