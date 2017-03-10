Create Database if not exists prescriptionsrx;
Use prescriptionsrx;

Create Table if not exists Doctor (
	DoctorId integer unsigned auto_increment not null,
	FirstName varchar(20) not null,
	LastName varchar(20) not null,
	Speciality varchar(20) not null,
	ExperienceYears integer not null,
	primary key (DoctorId)
);

Create Table if not exists Patient (
	PatientId integer unsigned auto_increment not null,
	FirstName varchar(20) not null,
	LastName varchar(20) not null,
	Town varchar(20) not null,
	StreetName varchar(20) not null,
	StreetNumber integer not null,
	PostalCode integer not null,
	Age integer not null,
	DoctorId integer unsigned not null,
	primary key (PatientId),
	foreign key (DoctorId) references Doctor(DoctorId) on delete cascade
);

Create Table if not exists Pharmacy (
	PharmacyId integer unsigned auto_increment not null,
	Name varchar(20) not null,
	Town varchar(20) not null,
	StreetName varchar(20) not null,
	StreetNumber integer not null,
	PostalCode integer not null,
	PhoneNumber integer not null,
	primary key (PharmacyId)
);

Create Table if not exists Company (
	CompanyId integer unsigned auto_increment not null,
	Name varchar(20) not null,
	PhoneNumber integer not null,
	primary key (CompanyId)
);

Create Table if not exists Drug (
	DrugId integer unsigned auto_increment not null,
	Name varchar(20) not null,
	Formula varchar(20) not null,
	CompanyId integer unsigned not null,
	primary key (DrugId),
	foreign key (CompanyId) references Company(CompanyId) on delete cascade
);

Create Table if not exists Prescription (
	PatientId integer unsigned not null,
	DoctorId integer unsigned not null,
	DrugId integer unsigned not null,
	PrescriptionDate date not null,
	Quantity integer not null,
	primary key(PatientId, DoctorId, DrugId),
	foreign key (PatientId) references Patient(PatientId) on delete cascade on update cascade,
	foreign key (DoctorId) references Doctor(DoctorId) on delete cascade on update cascade,
	foreign key (DrugId) references Drug(DrugId) on delete cascade on update cascade
);

Create Table if not exists Sell (
	PharmacyId integer unsigned not null,
	DrugId integer unsigned not null,
	Price integer not null,
	primary key (PharmacyId, DrugId),
	foreign key (PharmacyId) references Pharmacy(PharmacyId) on delete cascade on update cascade,
	foreign key (DrugId) references Drug(DrugId) on delete cascade on update cascade
);

Create Table if not exists Contract (
	PharmacyId integer unsigned not null,
	CompanyId integer unsigned not null,
	StartDate date not null,
	EndDate date not null,
	ContractText varchar(20) not null,
	Supervisor varchar(20) not null,
	primary key (PharmacyId, CompanyId),
	foreign key (PharmacyId) references Pharmacy(PharmacyId) on delete cascade on update cascade,
	foreign key (CompanyId) references Company(CompanyId) on delete cascade on update cascade
);
