<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassicmodelsSeeder extends Seeder
{
    public function run(): void
    {
        // Offices
        DB::table('offices')->insert([
            ['officeCode'=>'1','city'=>'San Francisco','phone'=>'+1 650 219 4782','addressLine1'=>'100 Market Street','addressLine2'=>'Suite 300','state'=>'CA','country'=>'USA','postalCode'=>'94080','territory'=>'NA'],
            ['officeCode'=>'2','city'=>'Boston','phone'=>'+1 215 837 0825','addressLine1'=>'1550 Court Place','addressLine2'=>'Suite 102','state'=>'MA','country'=>'USA','postalCode'=>'02107','territory'=>'NA'],
            ['officeCode'=>'3','city'=>'NYC','phone'=>'+1 212 555 3000','addressLine1'=>'523 East 53rd Street','addressLine2'=>'apt. 5A','state'=>'NY','country'=>'USA','postalCode'=>'10022','territory'=>'NA'],
            ['officeCode'=>'4','city'=>'Paris','phone'=>'+33 14 723 4404','addressLine1'=>'43 Rue Jouffroy','addressLine2'=>null,'state'=>null,'country'=>'France','postalCode'=>'75017','territory'=>'EMEA'],
            ['officeCode'=>'5','city'=>'Tokyo','phone'=>'+81 33 224 5000','addressLine1'=>'4-1 Kioicho','addressLine2'=>null,'state'=>null,'country'=>'Japan','postalCode'=>'102-8578','territory'=>'Japan'],
            ['officeCode'=>'6','city'=>'Sydney','phone'=>'+61 2 9264 2451','addressLine1'=>'5-11 Wentworth Avenue','addressLine2'=>'Floor #2','state'=>null,'country'=>'Australia','postalCode'=>'NSW 2010','territory'=>'APAC'],
            ['officeCode'=>'7','city'=>'London','phone'=>'+44 20 7877 2041','addressLine1'=>'25 Old Broad Street','addressLine2'=>'Level 7','state'=>null,'country'=>'UK','postalCode'=>'EC2N 1HN','territory'=>'EMEA'],
        ]);

        // Employees
        DB::table('employees')->insert([
            ['employeeNumber'=>1002,'lastName'=>'Murphy','firstName'=>'Diane','extension'=>'x5800','email'=>'dmurphy@classicmodelcars.com','officeCode'=>'1','reportsTo'=>null,'jobTitle'=>'President'],
            ['employeeNumber'=>1056,'lastName'=>'Patterson','firstName'=>'Mary','extension'=>'x4611','email'=>'mpatterso@classicmodelcars.com','officeCode'=>'1','reportsTo'=>1002,'jobTitle'=>'VP Sales'],
            ['employeeNumber'=>1076,'lastName'=>'Firrelli','firstName'=>'Jeff','extension'=>'x9273','email'=>'jfirrelli@classicmodelcars.com','officeCode'=>'1','reportsTo'=>1002,'jobTitle'=>'VP Marketing'],
            ['employeeNumber'=>1088,'lastName'=>'Patterson','firstName'=>'William','extension'=>'x4871','email'=>'wpatterson@classicmodelcars.com','officeCode'=>'6','reportsTo'=>1056,'jobTitle'=>'Sales Manager (APAC)'],
            ['employeeNumber'=>1102,'lastName'=>'Bondur','firstName'=>'Gerard','extension'=>'x5408','email'=>'gbondur@classicmodelcars.com','officeCode'=>'4','reportsTo'=>1056,'jobTitle'=>'Sale Manager (EMEA)'],
            ['employeeNumber'=>1143,'lastName'=>'Bow','firstName'=>'Anthony','extension'=>'x5428','email'=>'abow@classicmodelcars.com','officeCode'=>'1','reportsTo'=>1056,'jobTitle'=>'Sales Manager (NA)'],
            ['employeeNumber'=>1165,'lastName'=>'Jennings','firstName'=>'Leslie','extension'=>'x3291','email'=>'ljennings@classicmodelcars.com','officeCode'=>'1','reportsTo'=>1143,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1166,'lastName'=>'Thompson','firstName'=>'Leslie','extension'=>'x4065','email'=>'lthompson@classicmodelcars.com','officeCode'=>'1','reportsTo'=>1143,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1188,'lastName'=>'Firrelli','firstName'=>'Julie','extension'=>'x2173','email'=>'jfirrelli2@classicmodelcars.com','officeCode'=>'2','reportsTo'=>1143,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1216,'lastName'=>'Patterson','firstName'=>'Steve','extension'=>'x4334','email'=>'spatterson@classicmodelcars.com','officeCode'=>'2','reportsTo'=>1143,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1286,'lastName'=>'Tseng','firstName'=>'Foon Yue','extension'=>'x2248','email'=>'ftseng@classicmodelcars.com','officeCode'=>'3','reportsTo'=>1143,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1323,'lastName'=>'Vanauf','firstName'=>'George','extension'=>'x4102','email'=>'gvanauf@classicmodelcars.com','officeCode'=>'3','reportsTo'=>1143,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1337,'lastName'=>'Bondur','firstName'=>'Loui','extension'=>'x6493','email'=>'lbondur@classicmodelcars.com','officeCode'=>'4','reportsTo'=>1102,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1370,'lastName'=>'Hernandez','firstName'=>'Gerard','extension'=>'x2028','email'=>'ghernande@classicmodelcars.com','officeCode'=>'4','reportsTo'=>1102,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1401,'lastName'=>'Castillo','firstName'=>'Pamela','extension'=>'x2759','email'=>'pcastillo@classicmodelcars.com','officeCode'=>'4','reportsTo'=>1102,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1501,'lastName'=>'Bott','firstName'=>'Larry','extension'=>'x2311','email'=>'lbott@classicmodelcars.com','officeCode'=>'7','reportsTo'=>1102,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1504,'lastName'=>'Jones','firstName'=>'Barry','extension'=>'x102','email'=>'bjones@classicmodelcars.com','officeCode'=>'7','reportsTo'=>1102,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1611,'lastName'=>'Fixter','firstName'=>'Andy','extension'=>'x101','email'=>'afixter@classicmodelcars.com','officeCode'=>'6','reportsTo'=>1088,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1612,'lastName'=>'Marsh','firstName'=>'Peter','extension'=>'x102','email'=>'pmarsh@classicmodelcars.com','officeCode'=>'6','reportsTo'=>1088,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1619,'lastName'=>'King','firstName'=>'Tom','extension'=>'x103','email'=>'tking@classicmodelcars.com','officeCode'=>'6','reportsTo'=>1088,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1621,'lastName'=>'Nishi','firstName'=>'Mami','extension'=>'x101','email'=>'mnishi@classicmodelcars.com','officeCode'=>'5','reportsTo'=>1056,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1625,'lastName'=>'Kato','firstName'=>'Yoshimi','extension'=>'x102','email'=>'ykato@classicmodelcars.com','officeCode'=>'5','reportsTo'=>1621,'jobTitle'=>'Sales Rep'],
            ['employeeNumber'=>1702,'lastName'=>'Gerard','firstName'=>'Martin','extension'=>'x2312','email'=>'mgerard@classicmodelcars.com','officeCode'=>'4','reportsTo'=>1102,'jobTitle'=>'Sales Rep'],
        ]);

        // Product Lines
        DB::table('productlines')->insert([
            ['productLine'=>'Classic Cars','textDescription'=>'Attention car enthusiasts: Make your wildest car ownership dreams come true.','htmlDescription'=>null,'image'=>null],
            ['productLine'=>'Motorcycles','textDescription'=>'Our motorcycles are state of the art replicas of classic as well as contemporary motorcycle legends.','htmlDescription'=>null,'image'=>null],
            ['productLine'=>'Planes','textDescription'=>'Unique, diecast airplane and helicopter replicas suitable for a serious collector.','htmlDescription'=>null,'image'=>null],
            ['productLine'=>'Ships','textDescription'=>'The perfect holiday or anniversary gift for executives, clients, and employees.','htmlDescription'=>null,'image'=>null],
            ['productLine'=>'Trains','textDescription'=>'Model trains are a rewarding hobby for enthusiasts of all ages.','htmlDescription'=>null,'image'=>null],
            ['productLine'=>'Trucks and Buses','textDescription'=>'The Truck and Bus models and diecast merchandise are highly detailed replicas.','htmlDescription'=>null,'image'=>null],
            ['productLine'=>'Vintage Cars','textDescription'=>'Our Vintage Car models realistically portray automobiles produced from the 1900s through the 1940s.','htmlDescription'=>null,'image'=>null],
        ]);

        // Products
        DB::table('products')->insert([
            ['productCode'=>'S10_1678','productName'=>'1969 Harley Davidson Ultimate Chopper','productLine'=>'Motorcycles','productScale'=>'1:10','productVendor'=>'Min Lin Diecast','productDescription'=>'This replica features working kickstand, front suspension, gear-shift lever, footrests.','quantityInStock'=>7933,'buyPrice'=>48.81,'MSRP'=>95.70],
            ['productCode'=>'S10_1949','productName'=>'1952 Alpine Renault 1300','productLine'=>'Classic Cars','productScale'=>'1:10','productVendor'=>'Classic Metal Creations','productDescription'=>'Turnable front wheels; steering function; detailed interior; detailed engine; opening hood.','quantityInStock'=>7305,'buyPrice'=>98.58,'MSRP'=>214.30],
            ['productCode'=>'S10_2016','productName'=>'1996 Moto Guzzi 1100i','productLine'=>'Motorcycles','productScale'=>'1:10','productVendor'=>'Highway 66 Mini Classics','productDescription'=>'Official Moto Guzzi logos and insignias, saddle bags located on side of bike.','quantityInStock'=>6625,'buyPrice'=>68.99,'MSRP'=>118.94],
            ['productCode'=>'S10_4698','productName'=>'2003 Harley-Davidson Eagle Drag Bike','productLine'=>'Motorcycles','productScale'=>'1:10','productVendor'=>'Red Start Diecast','productDescription'=>'Model features, official Harley Davidson logos and insignias, detachable rear wheelie bar.','quantityInStock'=>5582,'buyPrice'=>91.02,'MSRP'=>193.66],
            ['productCode'=>'S10_4757','productName'=>'1972 Alfa Romeo GTA','productLine'=>'Classic Cars','productScale'=>'1:10','productVendor'=>'Motor City Art Classics','productDescription'=>'Features include: Turnable front wheels; steering function; detailed interior.','quantityInStock'=>3252,'buyPrice'=>85.68,'MSRP'=>136.00],
            ['productCode'=>'S10_4962','productName'=>'1962 LanciaA Delta 16V','productLine'=>'Classic Cars','productScale'=>'1:10','productVendor'=>'Second Gear Diecast','productDescription'=>'Features include: Turnable front wheels; steering function; detailed interior.','quantityInStock'=>6791,'buyPrice'=>103.42,'MSRP'=>147.74],
            ['productCode'=>'S12_1099','productName'=>'1968 Ford Mustang','productLine'=>'Classic Cars','productScale'=>'1:12','productVendor'=>'Autoart Studio Design','productDescription'=>'Hood, doors and trunk all open to reveal highly detailed interior features.','quantityInStock'=>68,'buyPrice'=>95.34,'MSRP'=>194.57],
            ['productCode'=>'S12_1108','productName'=>'2001 Ferrari Enzo','productLine'=>'Classic Cars','productScale'=>'1:12','productVendor'=>'Second Gear Diecast','productDescription'=>'Turnable front wheels; steering function; detailed interior; detailed engine.','quantityInStock'=>3253,'buyPrice'=>95.59,'MSRP'=>207.80],
            ['productCode'=>'S12_3148','productName'=>'1969 Corvette Convertible','productLine'=>'Classic Cars','productScale'=>'1:12','productVendor'=>'Classic Metal Creations','productDescription'=>'Gift for idealistes. 3 cars in 1 double-bedded with original conversion kit.','quantityInStock'=>1249,'buyPrice'=>50.43,'MSRP'=>122.00],
            ['productCode'=>'S12_3891','productName'=>'1969 Ford Falcon','productLine'=>'Classic Cars','productScale'=>'1:12','productVendor'=>'Second Gear Diecast','productDescription'=>'Turnable front wheels; steering function; detailed interior; detailed engine.','quantityInStock'=>1049,'buyPrice'=>83.05,'MSRP'=>173.98],
            ['productCode'=>'S18_1129','productName'=>'1993 Mazda RX-7','productLine'=>'Classic Cars','productScale'=>'1:18','productVendor'=>'Highway 66 Mini Classics','productDescription'=>'This model features, opening hood, opening doors, detailed engine, rear spoiler.','quantityInStock'=>3975,'buyPrice'=>83.51,'MSRP'=>141.54],
            ['productCode'=>'S18_1342','productName'=>'1937 Lincoln Berline','productLine'=>'Vintage Cars','productScale'=>'1:18','productVendor'=>'Motor City Art Classics','productDescription'=>'Turnable front wheels, steering function, detailed interior, opening hood, opening trunk.','quantityInStock'=>8693,'buyPrice'=>60.62,'MSRP'=>102.74],
            ['productCode'=>'S18_1367','productName'=>'1936 Mercedes-Benz 500K Special Roadster','productLine'=>'Vintage Cars','productScale'=>'1:18','productVendor'=>'Studio M Art Models','productDescription'=>'This 1:18 scale replica is constructed of heavy die-cast metal.','quantityInStock'=>8635,'buyPrice'=>24.26,'MSRP'=>53.91],
            ['productCode'=>'S18_1589','productName'=>'1965 Aston Martin DB5','productLine'=>'Classic Cars','productScale'=>'1:18','productVendor'=>'Classic Metal Creations','productDescription'=>'Die-cast model of the famous 1965 Aston Martin DB5 with opening hood, doors and trunk.','quantityInStock'=>9042,'buyPrice'=>65.96,'MSRP'=>124.44],
            ['productCode'=>'S18_1749','productName'=>'1917 Grand Touring Sedan','productLine'=>'Vintage Cars','productScale'=>'1:18','productVendor'=>'Welly Diecast Productions','productDescription'=>'This 1:18 scale replica of the 1917 Grand Touring Sedan has metal body components.','quantityInStock'=>2724,'buyPrice'=>86.70,'MSRP'=>170.00],
            ['productCode'=>'S18_2238','productName'=>'1998 Chrysler Plymouth Prowler','productLine'=>'Classic Cars','productScale'=>'1:18','productVendor'=>'Gearbox Collectibles','productDescription'=>'Turnable front wheels; steering function; detailed interior; detailed engine.','quantityInStock'=>4724,'buyPrice'=>101.51,'MSRP'=>163.69],
            ['productCode'=>'S18_2248','productName'=>'1911 Ford Town Car','productLine'=>'Vintage Cars','productScale'=>'1:18','productVendor'=>'Motor City Art Classics','productDescription'=>'Features opening hood, opening doors, opening trunk. A replica of the first Ford Town Car.','quantityInStock'=>540,'buyPrice'=>33.30,'MSRP'=>60.54],
            ['productCode'=>'S18_2325','productName'=>'1932 Model A Ford J-Coupe','productLine'=>'Vintage Cars','productScale'=>'1:18','productVendor'=>'Autoart Studio Design','productDescription'=>'This model features grille-mounted chrome horn, lift-off hood, rubber tires.','quantityInStock'=>9354,'buyPrice'=>58.48,'MSRP'=>127.36],
            ['productCode'=>'S18_2795','productName'=>'1928 Mercedes-Benz SSK','productLine'=>'Vintage Cars','productScale'=>'1:18','productVendor'=>'Gearbox Collectibles','productDescription'=>'This 1:18 scale replica is constructed of heavy die-cast metal. It has rubber tires.','quantityInStock'=>548,'buyPrice'=>72.56,'MSRP'=>168.75],
            ['productCode'=>'S24_1444','productName'=>'1970 Dodge Coronet','productLine'=>'Classic Cars','productScale'=>'1:24','productVendor'=>'Highway 66 Mini Classics','productDescription'=>'1:24 scale die-cast model. Opening hood and trunk; opening doors.','quantityInStock'=>4074,'buyPrice'=>32.37,'MSRP'=>61.89],
            ['productCode'=>'S24_2840','productName'=>'1958 Chevy Corvette Limited Edition','productLine'=>'Classic Cars','productScale'=>'1:24','productVendor'=>'Carousel DieCast Legends','productDescription'=>'The smooth contours were in sharp contrast to the bladed tailfins of its predecessor.','quantityInStock'=>2542,'buyPrice'=>15.91,'MSRP'=>35.36],
            ['productCode'=>'S24_3856','productName'=>'1956 Porsche 356A Coupe','productLine'=>'Classic Cars','productScale'=>'1:24','productVendor'=>'Classic Metal Creations','productDescription'=>'Turnable front wheels; steering function; detailed interior; detailed engine.','quantityInStock'=>6600,'buyPrice'=>98.30,'MSRP'=>140.43],
            ['productCode'=>'S32_1268','productName'=>'1980s Black Hawk Helicopter','productLine'=>'Planes','productScale'=>'1:32','productVendor'=>'Red Start Diecast','productDescription'=>'1:32 scale replica. Working tail and main rotor blades.','quantityInStock'=>5330,'buyPrice'=>77.27,'MSRP'=>157.69],
            ['productCode'=>'S700_2047','productName'=>'HMS Bounty','productLine'=>'Ships','productScale'=>'1:700','productVendor'=>'Unimax Art Galleries','productDescription'=>'Measures 30 inches Long x 11 inches High. Includes a Certificate of Authenticity.','quantityInStock'=>3501,'buyPrice'=>39.83,'MSRP'=>90.52],
        ]);

        // Customers
        DB::table('customers')->insert([
            ['customerNumber'=>103,'customerName'=>'Atelier graphique','contactLastName'=>'Schmitt','contactFirstName'=>'Carine','phone'=>'40.32.2555','addressLine1'=>'54, rue Royale','addressLine2'=>null,'city'=>'Nantes','state'=>null,'postalCode'=>'44000','country'=>'France','salesRepEmployeeNumber'=>1370,'creditLimit'=>21000.00],
            ['customerNumber'=>112,'customerName'=>'Signal Gift Stores','contactLastName'=>'King','contactFirstName'=>'Jean','phone'=>'7025551838','addressLine1'=>'8489 Strong St.','addressLine2'=>null,'city'=>'Las Vegas','state'=>'NV','postalCode'=>'83030','country'=>'USA','salesRepEmployeeNumber'=>1166,'creditLimit'=>71800.00],
            ['customerNumber'=>114,'customerName'=>'Australian Collectors, Co.','contactLastName'=>'Ferguson','contactFirstName'=>'Peter','phone'=>'03 9520 4555','addressLine1'=>'636 St Kilda Road','addressLine2'=>'Level 3','city'=>'Melbourne','state'=>'Victoria','postalCode'=>'3004','country'=>'Australia','salesRepEmployeeNumber'=>1611,'creditLimit'=>117300.00],
            ['customerNumber'=>119,'customerName'=>'La Rochelle Gifts','contactLastName'=>'Labrune','contactFirstName'=>'Janine','phone'=>'40.67.8555','addressLine1'=>'67, rue des Cinquante Otages','addressLine2'=>null,'city'=>'Nantes','state'=>null,'postalCode'=>'44000','country'=>'France','salesRepEmployeeNumber'=>1370,'creditLimit'=>118200.00],
            ['customerNumber'=>121,'customerName'=>'Baane Mini Imports','contactLastName'=>'Bergulfsen','contactFirstName'=>'Jonas','phone'=>'07-98 9555','addressLine1'=>'Erling Skakkes gate 78','addressLine2'=>null,'city'=>'Stavern','state'=>null,'postalCode'=>'4110','country'=>'Norway','salesRepEmployeeNumber'=>1504,'creditLimit'=>81700.00],
            ['customerNumber'=>124,'customerName'=>'Mini Gifts Distributors Ltd.','contactLastName'=>'Nelson','contactFirstName'=>'Susan','phone'=>'4155551450','addressLine1'=>'5677 Strong St.','addressLine2'=>null,'city'=>'San Rafael','state'=>'CA','postalCode'=>'97562','country'=>'USA','salesRepEmployeeNumber'=>1165,'creditLimit'=>210500.00],
            ['customerNumber'=>125,'customerName'=>'Havel & Zbyszek Co','contactLastName'=>'Piestrzeniewicz','contactFirstName'=>'Zbyszek','phone'=>'(26) 642-7555','addressLine1'=>'ul. Filtrowa 68','addressLine2'=>null,'city'=>'Warszawa','state'=>null,'postalCode'=>'01-012','country'=>'Poland','salesRepEmployeeNumber'=>null,'creditLimit'=>0.00],
            ['customerNumber'=>128,'customerName'=>'Blauer See Auto, Co.','contactLastName'=>'Keitel','contactFirstName'=>'Roland','phone'=>'+49 69 66 90 2555','addressLine1'=>'Lyonerstr. 34','addressLine2'=>null,'city'=>'Frankfurt','state'=>null,'postalCode'=>'60528','country'=>'Germany','salesRepEmployeeNumber'=>1504,'creditLimit'=>59700.00],
            ['customerNumber'=>129,'customerName'=>'Mini Wheels Co.','contactLastName'=>'Murphy','contactFirstName'=>'Julie','phone'=>'6505555787','addressLine1'=>'5557 North Penelope St','addressLine2'=>null,'city'=>'San Francisco','state'=>'CA','postalCode'=>'94217','country'=>'USA','salesRepEmployeeNumber'=>1165,'creditLimit'=>64600.00],
            ['customerNumber'=>131,'customerName'=>'Land of Toys Inc.','contactLastName'=>'Lee','contactFirstName'=>'Kwai','phone'=>'2125557818','addressLine1'=>'897 Long Airport Avenue','addressLine2'=>null,'city'=>'NYC','state'=>'NY','postalCode'=>'10022','country'=>'USA','salesRepEmployeeNumber'=>1323,'creditLimit'=>114900.00],
            ['customerNumber'=>141,'customerName'=>'Euro+ Shopping Channel','contactLastName'=>'Freyre','contactFirstName'=>'Diego','phone'=>'(91) 555 94 44','addressLine1'=>'C/ Moralzarzal, 86','addressLine2'=>null,'city'=>'Madrid','state'=>null,'postalCode'=>'28034','country'=>'Spain','salesRepEmployeeNumber'=>1370,'creditLimit'=>227600.00],
            ['customerNumber'=>148,'customerName'=>'Dragon Souveniers, Ltd.','contactLastName'=>'Natividad','contactFirstName'=>'Eric','phone'=>'+65 221 7555','addressLine1'=>'Bronz Sok.','addressLine2'=>'Bronz Apt. 3/6 Sol','city'=>'Singapore','state'=>null,'postalCode'=>null,'country'=>'Singapore','salesRepEmployeeNumber'=>1621,'creditLimit'=>103800.00],
            ['customerNumber'=>171,'customerName'=>'Daedalus Designs Imports','contactLastName'=>'Ranc','contactFirstName'=>'Martine','phone'=>'20.16.1555','addressLine1'=>'184, chaussee de Tournai','addressLine2'=>null,'city'=>'Lille','state'=>null,'postalCode'=>'59000','country'=>'France','salesRepEmployeeNumber'=>1370,'creditLimit'=>82900.00],
            ['customerNumber'=>181,'customerName'=>'Vitachrome Inc.','contactLastName'=>'Frick','contactFirstName'=>'Michael','phone'=>'2125551500','addressLine1'=>'2678 Kingston Rd.','addressLine2'=>'Suite 101','city'=>'NYC','state'=>'NY','postalCode'=>'10022','country'=>'USA','salesRepEmployeeNumber'=>1286,'creditLimit'=>76400.00],
            ['customerNumber'=>363,'customerName'=>'Online Diecast Creations Co.','contactLastName'=>'Young','contactFirstName'=>'Dorothy','phone'=>'6035558647','addressLine1'=>'2304 Long Airport Avenue','addressLine2'=>null,'city'=>'Nashua','state'=>'NH','postalCode'=>'62005','country'=>'USA','salesRepEmployeeNumber'=>1216,'creditLimit'=>114200.00],
        ]);

        // Orders
        DB::table('orders')->insert([
            ['orderNumber'=>10100,'orderDate'=>'2003-01-06','requiredDate'=>'2003-01-13','shippedDate'=>'2003-01-10','status'=>'Shipped','comments'=>null,'customerNumber'=>363],
            ['orderNumber'=>10101,'orderDate'=>'2003-01-09','requiredDate'=>'2003-01-18','shippedDate'=>'2003-01-11','status'=>'Shipped','comments'=>'Check on availability.','customerNumber'=>128],
            ['orderNumber'=>10102,'orderDate'=>'2003-01-10','requiredDate'=>'2003-01-18','shippedDate'=>'2003-01-14','status'=>'Shipped','comments'=>null,'customerNumber'=>181],
            ['orderNumber'=>10103,'orderDate'=>'2003-01-29','requiredDate'=>'2003-02-07','shippedDate'=>'2003-02-02','status'=>'Shipped','comments'=>null,'customerNumber'=>121],
            ['orderNumber'=>10104,'orderDate'=>'2003-01-31','requiredDate'=>'2003-02-09','shippedDate'=>'2003-02-01','status'=>'Shipped','comments'=>null,'customerNumber'=>141],
            ['orderNumber'=>10107,'orderDate'=>'2003-02-24','requiredDate'=>'2003-03-03','shippedDate'=>'2003-02-26','status'=>'Shipped','comments'=>'Difficult to negotiate with customer.','customerNumber'=>131],
            ['orderNumber'=>10108,'orderDate'=>'2003-03-03','requiredDate'=>'2003-03-12','shippedDate'=>'2003-03-08','status'=>'Shipped','comments'=>null,'customerNumber'=>121],
            ['orderNumber'=>10109,'orderDate'=>'2003-03-10','requiredDate'=>'2003-03-19','shippedDate'=>'2003-03-11','status'=>'Shipped','comments'=>'Customer requested FedEx Ground','customerNumber'=>171],
            ['orderNumber'=>10110,'orderDate'=>'2003-03-18','requiredDate'=>'2003-03-24','shippedDate'=>'2003-03-20','status'=>'Shipped','comments'=>null,'customerNumber'=>124],
            ['orderNumber'=>10111,'orderDate'=>'2003-03-25','requiredDate'=>'2003-03-31','shippedDate'=>'2003-03-30','status'=>'Shipped','comments'=>null,'customerNumber'=>148],
            ['orderNumber'=>10112,'orderDate'=>'2003-03-24','requiredDate'=>'2003-04-03','shippedDate'=>'2003-03-29','status'=>'Shipped','comments'=>'Customer requested ad materials.','customerNumber'=>124],
            ['orderNumber'=>10113,'orderDate'=>'2003-03-26','requiredDate'=>'2003-04-02','shippedDate'=>'2003-03-27','status'=>'Shipped','comments'=>null,'customerNumber'=>103],
            ['orderNumber'=>10114,'orderDate'=>'2003-04-01','requiredDate'=>'2003-04-07','shippedDate'=>'2003-04-02','status'=>'Shipped','comments'=>null,'customerNumber'=>112],
            ['orderNumber'=>10115,'orderDate'=>'2003-04-04','requiredDate'=>'2003-04-12','shippedDate'=>'2003-04-07','status'=>'Shipped','comments'=>null,'customerNumber'=>119],
            ['orderNumber'=>10116,'orderDate'=>'2003-04-11','requiredDate'=>'2003-04-19','shippedDate'=>'2003-04-13','status'=>'Shipped','comments'=>null,'customerNumber'=>129],
            ['orderNumber'=>10117,'orderDate'=>'2003-04-16','requiredDate'=>'2003-04-24','shippedDate'=>'2003-04-17','status'=>'Shipped','comments'=>null,'customerNumber'=>131],
            ['orderNumber'=>10118,'orderDate'=>'2003-04-25','requiredDate'=>'2003-05-02','shippedDate'=>'2003-04-26','status'=>'Shipped','comments'=>null,'customerNumber'=>141],
            ['orderNumber'=>10119,'orderDate'=>'2003-05-08','requiredDate'=>'2003-05-19','shippedDate'=>'2003-05-15','status'=>'Shipped','comments'=>null,'customerNumber'=>114],
            ['orderNumber'=>10120,'orderDate'=>'2003-07-12','requiredDate'=>'2003-07-19','shippedDate'=>'2003-07-19','status'=>'Shipped','comments'=>null,'customerNumber'=>103],
            ['orderNumber'=>10121,'orderDate'=>'2003-07-15','requiredDate'=>'2003-07-24','shippedDate'=>'2003-07-23','status'=>'Shipped','comments'=>null,'customerNumber'=>124],
        ]);

        // Order Details
        DB::table('orderdetails')->insert([
            ['orderNumber'=>10100,'productCode'=>'S18_1749','quantityOrdered'=>30,'priceEach'=>136.00,'orderLineNumber'=>3],
            ['orderNumber'=>10100,'productCode'=>'S18_2248','quantityOrdered'=>50,'priceEach'=>55.09,'orderLineNumber'=>2],
            ['orderNumber'=>10101,'productCode'=>'S18_2325','quantityOrdered'=>25,'priceEach'=>108.06,'orderLineNumber'=>4],
            ['orderNumber'=>10101,'productCode'=>'S18_1589','quantityOrdered'=>26,'priceEach'=>67.14,'orderLineNumber'=>1],
            ['orderNumber'=>10102,'productCode'=>'S18_1342','quantityOrdered'=>39,'priceEach'=>95.55,'orderLineNumber'=>2],
            ['orderNumber'=>10102,'productCode'=>'S18_1367','quantityOrdered'=>41,'priceEach'=>43.13,'orderLineNumber'=>1],
            ['orderNumber'=>10103,'productCode'=>'S10_1678','quantityOrdered'=>26,'priceEach'=>86.13,'orderLineNumber'=>2],
            ['orderNumber'=>10103,'productCode'=>'S10_2016','quantityOrdered'=>15,'priceEach'=>93.01,'orderLineNumber'=>1],
            ['orderNumber'=>10104,'productCode'=>'S12_1099','quantityOrdered'=>25,'priceEach'=>182.90,'orderLineNumber'=>1],
            ['orderNumber'=>10104,'productCode'=>'S12_3148','quantityOrdered'=>27,'priceEach'=>96.34,'orderLineNumber'=>2],
            ['orderNumber'=>10107,'productCode'=>'S10_1678','quantityOrdered'=>30,'priceEach'=>81.35,'orderLineNumber'=>2],
            ['orderNumber'=>10107,'productCode'=>'S10_4962','quantityOrdered'=>22,'priceEach'=>143.35,'orderLineNumber'=>1],
            ['orderNumber'=>10108,'productCode'=>'S10_2016','quantityOrdered'=>34,'priceEach'=>109.42,'orderLineNumber'=>1],
            ['orderNumber'=>10109,'productCode'=>'S10_4698','quantityOrdered'=>26,'priceEach'=>184.74,'orderLineNumber'=>1],
            ['orderNumber'=>10110,'productCode'=>'S18_2238','quantityOrdered'=>31,'priceEach'=>164.34,'orderLineNumber'=>1],
            ['orderNumber'=>10111,'productCode'=>'S10_4757','quantityOrdered'=>25,'priceEach'=>127.08,'orderLineNumber'=>1],
            ['orderNumber'=>10112,'productCode'=>'S10_1949','quantityOrdered'=>20,'priceEach'=>190.00,'orderLineNumber'=>1],
            ['orderNumber'=>10113,'productCode'=>'S10_1678','quantityOrdered'=>29,'priceEach'=>75.00,'orderLineNumber'=>1],
            ['orderNumber'=>10114,'productCode'=>'S10_1949','quantityOrdered'=>45,'priceEach'=>195.00,'orderLineNumber'=>1],
            ['orderNumber'=>10115,'productCode'=>'S10_4757','quantityOrdered'=>25,'priceEach'=>127.08,'orderLineNumber'=>1],
            ['orderNumber'=>10116,'productCode'=>'S18_1129','quantityOrdered'=>18,'priceEach'=>138.22,'orderLineNumber'=>1],
            ['orderNumber'=>10117,'productCode'=>'S12_1108','quantityOrdered'=>22,'priceEach'=>205.72,'orderLineNumber'=>1],
            ['orderNumber'=>10118,'productCode'=>'S18_2795','quantityOrdered'=>32,'priceEach'=>162.00,'orderLineNumber'=>1],
            ['orderNumber'=>10119,'productCode'=>'S24_1444','quantityOrdered'=>40,'priceEach'=>55.80,'orderLineNumber'=>1],
            ['orderNumber'=>10120,'productCode'=>'S24_2840','quantityOrdered'=>18,'priceEach'=>34.18,'orderLineNumber'=>1],
            ['orderNumber'=>10121,'productCode'=>'S24_3856','quantityOrdered'=>36,'priceEach'=>131.61,'orderLineNumber'=>1],
        ]);

        // Payments
        DB::table('payments')->insert([
            ['customerNumber'=>103,'checkNumber'=>'HQ336336','paymentDate'=>'2004-10-19','amount'=>6066.78],
            ['customerNumber'=>103,'checkNumber'=>'JM555205','paymentDate'=>'2003-06-05','amount'=>14571.44],
            ['customerNumber'=>103,'checkNumber'=>'OM314933','paymentDate'=>'2004-12-18','amount'=>1676.14],
            ['customerNumber'=>112,'checkNumber'=>'BO864823','paymentDate'=>'2004-12-17','amount'=>14191.12],
            ['customerNumber'=>112,'checkNumber'=>'HQ55022','paymentDate'=>'2003-06-06','amount'=>32641.98],
            ['customerNumber'=>112,'checkNumber'=>'ND748010','paymentDate'=>'2004-08-20','amount'=>33347.88],
            ['customerNumber'=>114,'checkNumber'=>'GG31455','paymentDate'=>'2003-05-20','amount'=>45864.03],
            ['customerNumber'=>114,'checkNumber'=>'MA765515','paymentDate'=>'2004-11-15','amount'=>82261.22],
            ['customerNumber'=>119,'checkNumber'=>'DB933704','paymentDate'=>'2004-11-14','amount'=>19450.80],
            ['customerNumber'=>124,'checkNumber'=>'AE215433','paymentDate'=>'2005-03-05','amount'=>101244.59],
            ['customerNumber'=>124,'checkNumber'=>'BG255406','paymentDate'=>'2004-08-28','amount'=>59551.38],
            ['customerNumber'=>128,'checkNumber'=>'GP803089','paymentDate'=>'2003-10-26','amount'=>10223.83],
            ['customerNumber'=>129,'checkNumber'=>'ID449593','paymentDate'=>'2003-11-26','amount'=>28111.90],
            ['customerNumber'=>131,'checkNumber'=>'DS448578','paymentDate'=>'2003-11-25','amount'=>16700.47],
            ['customerNumber'=>141,'checkNumber'=>'CI381435','paymentDate'=>'2003-11-15','amount'=>26514.40],
            ['customerNumber'=>148,'checkNumber'=>'FJ920185','paymentDate'=>'2004-01-12','amount'=>39964.63],
            ['customerNumber'=>171,'checkNumber'=>'HR224331','paymentDate'=>'2003-12-01','amount'=>43486.83],
            ['customerNumber'=>181,'checkNumber'=>'IR661279','paymentDate'=>'2004-02-28','amount'=>46895.48],
            ['customerNumber'=>363,'checkNumber'=>'PO253533','paymentDate'=>'2004-04-22','amount'=>48048.15],
            ['customerNumber'=>121,'checkNumber'=>'KA375871','paymentDate'=>'2003-05-22','amount'=>40206.20],
        ]);
    }
}
