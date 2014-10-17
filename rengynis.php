<?php
/*
 Testas patikrinantis svetaine, 
1. Patikrinama renginių paieška 
2. Patikrinami pagrindiniai renginių parametrai (foto, laikas, data) 
3. Patikrinimas salės planas 
4. Patikrinimas renginio kainos 
5. Patikrinimas renginio aprašymas 
6. Patikrinami kiti renginio parametrai

*/


// An example of using php-webdriver.
error_reporting(E_ALL);
require_once('lib/__init__.php');

// start Firefox with 5 second timeout
$host = 'http://127.0.0.1:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::firefox();
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

// navigate to 'http://dev.bilietai.lt/kasa/lt'
$driver->get('https://test.bilietai.lt');
$driver->manage()->window()->maximize();
//$sScriptResult = $driver->executeScript('return window.document.location.hostname',array());
//echo  $sScriptResult;
$driver->get('https://test.bilietai.lt');


// surandame search lauka ir ivedame teksta VOPLI VIDOPLIASOVA 
$input = $driver->findElement(WebDriverBy::id("keyword"));
$input->sendKeys("VOPLI VIDOPLIASOVA");

// surandame seach mygtuka ir klikiname ant jo
$link = $driver->findElement(WebDriverBy::xpath('/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[1]/form/table/tbody/tr/td[2]/input'));
$link->click();

// sirandame musu rengyni ir klikinam ant jo
$link = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[3]/div/div[2]/table/tbody/tr/td/div/div/table/tbody/tr[1]/td[2]/div/h2/a"));
$link->click();

echo "1. Patikrinama renginių paieška  (veikia) <br>";
echo "<h3>Testas atliktas  sekmingai </h3> <br>";
// patikrinam ar yra foto renginio
try {
	
	$input = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/table/tbody/tr/td/div/div/div/div[1]/div/table/tbody/tr/td[1]/img"));
	echo "2. Patikrinami pagrindiniai renginių parametrai: foto (egzistuoja) <br> ";
	echo "<h3>Testas atliktas  sekmingai </h3> <br>";
} 
	catch(NoSuchElementException $e) {
	echo "Renginio foto neegzistuoja<br>";
}

// patikrinam ar yra data renginio
try {
	
	$input = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/table/tbody/tr/td/div/div/div/div[1]/div/table/tbody/tr/td[2]/div[2]/table/tbody/tr[2]/td[1]/a"));
	echo "3. Patikrinami pagrindiniai renginių parametrai: data (egzistuoja) <br> ";
	echo "<h3>Testas atliktas  sekmingai </h3> <br>";
} 
	catch(NoSuchElementException $e) {
	echo "Renginio data neegzistuoja<br>";
}


// patikrinam ar yra laikas renginio
try {
	 
	$input = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/table/tbody/tr/td/div/div/div/div[1]/div/table/tbody/tr/td[2]/div[2]/table/tbody/tr[2]/td[1]/a"));
	echo "4. Patikrinami pagrindiniai renginių parametrai: laikas (egzistuoja) <br> ";
	//Isgauname data ir laika
	$input = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/table/tbody/tr/td/div/div/div/div[1]/div/table/tbody/tr/td[2]/div[2]/table/tbody/tr[2]/td[1]/a"))->getText();
	//floatval ($input);
	// isvedame data ir laika
	echo  "Renginio data ir laikas: \n $input <br>";
	
	echo "<h3>Testas atliktas  sekmingai </h3> <br>";
} 
	catch(NoSuchElementException $e) {
	echo "Renginio laikas neegzistuoja <br>";
}

// vel laukiam mygtuko 
$driver->wait(10)->until(
	WebDriverExpectedCondition::visibilityOfElementLocated(
		WebDriverBy::xpath('/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/table/tbody/tr/td/div/div/div/div[1]/div/table/tbody/tr/td[2]/div[2]/table/tbody/tr[2]/td[4]/a/span')
  )
);


/*
//Isgauname data ir laika
$input = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/table/tbody/tr/td/div/div/div/div[1]/div/table/tbody/tr/td[2]/div[2]/table/tbody/tr[2]/td[1]/a"))->getText();

//floatval ($input);


// isvedame data ir laika
echo  "Renginio data ir laikas: \n $input <br>";
*/


//surandame mygtuka biletai ir klikiname ant jo
$link = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/table/tbody/tr/td/div/div/div/div[1]/div/table/tbody/tr/td[2]/div[2]/table/tbody/tr[2]/td[4]/a/span"));
$link->click();



$driver->wait(15)->until(
  WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
  WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/div/div[1]/table/tbody/tr/td/div/div/div[1]/div[2]/div/div/div[2]/div/div")
  )
);


// patikrinam ar yra planas sales renginio
try {
	 
	$input = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/div/div[1]/table/tbody/tr/td/div/div/div[1]/div[2]/div/div/div[2]/div/div"));
	echo "5. Patikrinamas sales planas (egzistuoja) <br> ";
	echo "<h3>Testas atliktas  sekmingai </h3> <br>";
} 
	catch(NoSuchElementException $e) {
	echo "Sales planas neegzistuoja <br>";
}


// patikrinam rengynio kainas
try {
	 
	$input = $driver->findElement(WebDriverBy::id("price_44605"));
	$input = $driver->findElement(WebDriverBy::id("price_44606"));
	$input = $driver->findElement(WebDriverBy::id("price_44607"));
	$input = $driver->findElement(WebDriverBy::id("price_44614"));
	$input = $driver->findElement(WebDriverBy::id("price_44608"));
	$input = $driver->findElement(WebDriverBy::id("price_44612"));
	$input = $driver->findElement(WebDriverBy::id("price_44611"));
	$input = $driver->findElement(WebDriverBy::id("price_44610"));
	$input = $driver->findElement(WebDriverBy::id("price_44609"));
	echo "6. Patikrinamos kainos renginio (egzistuoja) <br> ";
	echo "<h3>Testas atliktas  sekmingai </h3> <br>";
} 
	catch(NoSuchElementException $e) {
	echo "Renginio kainu neegzistuoja <br>";
}



//surandame mygtuka aprasymas
$link = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/div/table/tbody/tr/td/div/div/div/div[2]/div[1]/a"));
$link->click();



// patikrinam rengynio aprasyma
try {
	 
	$input = $driver->findElement(WebDriverBy::xpath("/html/body/table/tbody/tr[1]/td/table/tbody/tr[2]/td[2]/div/table/tbody/tr/td[1]/div[5]/div[2]/div/table/tbody/tr/td/div/div/div/div[2]/div[2]/div"));
	echo "7. Patikrinamas renginio aprasymas (egzistuoja) <br> ";
	echo "<h3>Testas atliktas  sekmingai </h3> <br>";
} 
	catch(NoSuchElementException $e) {
	echo "Renginio aprasymas neegzistuoja <br>";
}




// close the Firefox
$driver->quit();





