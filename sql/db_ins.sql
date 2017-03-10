Use prescriptionsrx;

Insert into prescriptionsrx.Doctor
	(DoctorId, FirstName, LastName, Speciality, ExperienceYears)
values
	(1, 'Benedict', 'Cumberbatch', 'Neurosurgeon', 42),
	(2, 'Hugh', 'Laurie', 'Gynecologist', 20),
	(3, 'Paris', 'Hilton', 'Dermatologist', 12),
	(4, 'Samuel', 'Jackson', 'Pathologist', 17),
	(5, 'Emma', 'Stone', 'Pediatrician', 2);

Insert into prescriptionsrx.Pharmacy
	(PharmacyId, Name, Town, StreetName, StreetNumber, PostalCode, PhoneNumber)
values
	(1, "PharmacyOne", "TownOne", "StreetOne", 11, 16345, 2101235467),
	(2, "PharmacyTwo", "TownTwo", "StreetTwo", 12, 16346, 2101234568),
	(3, "PharmacyThree", "TownThree", "StreetThree", 13, 16347, 2101234569),
	(4, "PharmacyFour", "TownFour", "StreetFour", 14, 16348, 2101234570),
	(5, "PharmacyFive", "TownFive", "StreetFive", 15, 16349, 2101234571);

Insert into prescriptionsrx.Company
	(CompanyId, Name, PhoneNumber)
values
	(1, "CompanyOne", 2101122334),
	(2, "CompanyTwo", 2101122335),
	(3, "CompanyThree", 2101122336),
	(4, "CompanyFour", 2101122337),
	(5, "CompanyFive", 2101122338);

Insert into prescriptionsrx.Drug
	(DrugId, Name, Formula, CompanyId)
values
	(1, "DrugOne", "FormulaOne", 1),
	(2, "DrugTwo", "FormulaTwo", 2),
	(3, "DrugThree", "FormulaThree", 3),
	(4, "DrugFour", "FormulaFour", 4),
	(5, "DrugFive", "FormulaFive", 5);

Insert into prescriptionsrx.Patient
	(PatientId, FirstName, LastName, Town, StreetName, StreetNumber, PostalCode, Age, DoctorId)
values
	(1, "NameOne", "SurnameOne", "TownOne", "StreetOne", 21, 12345, 10, 1),
	(2, "NameTwo", "SurnameTwo", "TownTwo", "StreetTwo", 22, 12346, 20, 2),
	(3, "NameThree", "SurnameThree", "TownThree", "StreetThree", 23, 12347, 30, 3),
	(4, "NameFour", "SurnameFour", "TownFour", "StreetFour", 24, 12348, 40, 4),
	(5, "NameFive", "SurnameFive", "TownFive", "StreetFive", 25, 12349, 50, 5);

Insert into prescriptionsrx.Prescription
	(PatientId, DoctorId, DrugId, PrescriptionDate, Quantity)
values
	(1, 2, 3, "2017-1-21", 100),
	(2, 3, 4, "2017-2-22", 200),
	(3, 4, 5, "2017-3-23", 300),
	(4, 5, 1, "2017-4-24", 400),
	(5, 1, 2, "2017-5-25", 500);

Insert into prescriptionsrx.Sell
	(PharmacyId, DrugId, Price)
values
	(1, 2, 10),
	(2, 3, 15),
	(3, 4, 20),
	(4, 5, 25),
	(5, 1, 30);

Insert into prescriptionsrx.Contract
	(PharmacyId, CompanyId, StartDate, EndDate, ContractText, Supervisor)
values
	(1, 2, "2017-1-10", "2017-2-11", "TextOne", "SupervisorOne"),
	(2, 3, "2017-2-12", "2017-3-13", "TextTwo", "SupervisorTwo"),
	(3, 4, "2017-3-14", "2017-4-15", "TextThree", "SupervisorThree"),
	(4, 5, "2017-4-16", "2017-5-17", "TextFour", "SupervisorFour"),
	(5, 1, "2017-5-18", "2017-6-19", "TextFive", "SupervisorFive");
