-- Non-updatable view of the Patient table
-- shows only patient's first name, last name and age
create view patientView as
select p.FirstName, p.LastName, p.Age
from Patient as p
group by p.Age


-- Updatable view of the Contract table
-- hides the contract's text
create view contractView as
select c.PharmacyId, c.CompanyId, c.StartDate, c.EndDate, c.Supervisor
from Contract as c
