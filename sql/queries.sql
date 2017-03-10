--| INDEX |--

-- Number of Pharmacies
select count(PharmacyId)
from Pharmacy

-- Average experience years of all the Doctors
select avg(ExperienceYears)
from Doctor

-- Average drug count of all the Pharmacies
select avg(tmp.c)
from (
	SELECT count(Drug.DrugId) as c
	from ((Pharmacy inner join Sell on (Pharmacy.PharmacyId=Sell.PharmacyId)) 
		   inner join Drug on Sell.DrugId=Drug.DrugId)
	group by Pharmacy.PharmacyId
) as tmp


--| COMPANY |--

-- List of the Pharmacies with which the selected Company has a Contract
SELECT Pharmacy.Name, Pharmacy.PhoneNumber
FROM (Pharmacy inner join Contract on Pharmacy.PharmacyId=Contract.PharmacyId) inner join Company on Company.CompanyId=Contract.CompanyId
WHERE Company.CompanyId='user_input'

-- List of the Drugs the selected Company manufactures
SELECT Drug.Name, Drug.Formula
FROM (Drug inner join Company on Drug.CompanyId=Company.CompanyId)
WHERE Company.CompanyId='user_input'


--| PHARMACY |--

-- List of the Pharmacies with average Drug price the user enters
SELECT Pharmacy.Name, avg(Sell.Price) as avgPrice, Pharmacy.StreetName, Pharmacy.StreetNumber,
	   Pharmacy.PostalCode, Pharmacy.Town, Pharmacy.PhoneNumber
FROM ((Pharmacy inner join Sell on (Pharmacy.PharmacyId=Sell.PharmacyId)) 
	   inner join Drug on Sell.DrugId=Drug.DrugId)
GROUP BY Pharmacy.Name
HAVING avg(Sell.Price) <= 'user_input'

-- List of the Pharmacies on the same area (same Postal Code)
SELECT * FROM Pharmacy
WHERE Pharmacy.PostalCode = 'user_input'


--| MEDICINE |--

-- List of the Drugs with the selected Formula
SELECT Drug.Name
FROM Drug
WHERE Drug.Name IN (SELECT Name
                    FROM Drug
                    WHERE Formula='user_input')


--| DOCTOR |--

-- Find Doctors of a given specialty, with minimum experience of given number of years
SELECT Doctor.FirstName, Doctor.LastName, Doctor.ExperienceYears
FROM Doctor
WHERE Speciality = 'user_input' and ExperienceYears >= 'user_input'
ORDER BY ExperienceYears DESC

-- Total Quantity of drugs a specific doctor has prescribed
SELECT Doctor.FirstName, Doctor.LastName, sum(Prescription.Quantity) as amount
FROM (Doctor inner join Prescription on Doctor.DoctorId=Prescription.DoctorId) 
	  inner join Patient on (Prescription.PatientId=Patient.PatientId)
WHERE Doctor.DoctorId = 'user_input'
