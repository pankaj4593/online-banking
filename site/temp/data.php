<?php
require_once("class_neuralnetwork.php");
$r = $_POST['red'];
$g = $_POST['green'];
$b = $_POST['blue'];

$n = new NeuralNetwork(4, 4, 1); //initialize the neural network
$n->setVerbose(false);
$n->load('my_network.ini'); // load the saved weights into the initialized neural network. This way you won't need to train the network each time the application has been executed

$input = array(normalize($r),normalize($g),normalize($b));  //note that you will have to write a normalize function, depending on your needs

$result = $n->calculate($input);
If($result>0.5) {
// the dominant color is blue
}
else {
// the dominant color is red
}
?>