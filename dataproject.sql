insert  into `signin`(`uemail`,`upass`) values 
('alex.gordon97@gmail.com', 'pass@12345'),
('mike2020@bloomberg.org', 'bloomingguy#768'),
('elizabethwarren.hbs@yahoo.com', 'iamfor2020@win'),
('rajeshsharma1975@gmail.com', 'rumplustelskin@123'),
('xiang.zhao956@aol.com', 'xiang34@prchina'),
('miguel.hernandez@gmail.com', 'ownerrealestate#082'),
('shrutika19newyork@gmail.com', 'realnewyorker129'),
('xinjiangmao@rocketmail.com', 'chinain45@newyork'),
('iamcooper260@gmail.com', 'qazwsxedcqaz#90120'),
('rahulgarg156989@gmail.com', 'rahulhere4u@678');

insert  into `user`(`uemail`, `ufname`, `ulname`, `ubio`, `upic`, `ufamily`) values 
('alex.gordon97@gmail.com', 'Alex', 'Gordon', 'Hi there, I am from New York. I work as a software engineer', NULL, 'We a family of 5- Alex, Mike, Joey, Melania, Jordan'),
('mike2020@bloomberg.org', 'Alex', 'Gordon', 'I am the owner of Bloomberg LLC and I am also the 2020 presidential candidate', NULL, 'My family- Diana(wife), Georgina Bloomberg(daughter), Emma Bloomberg(daughter)'),
('elizabethwarren.hbs@yahoo.com', 'Elizabeth', 'Warren', 'Former Harvard Law School Professor, 2020 presidential candidate', NULL, ''),
('rajeshsharma1975@gmail.com', 'Rajesh', 'Sharma', 'Professor at NYU', NULL, 'Family: Swati(my wife), my daughter- Helena'),
('xiang.zhao956@aol.com', 'Xiang', 'Zhao', 'Student at NYU Tandon', NULL, 'Jianjing- My mom, Xi- my dad, shiniyang- my sister'),
('miguel.hernandez@gmail.com', 'Miguel', 'Hernandez', 'Owner at Realty props', NULL, 'MY family includes my mom Helena, my wife Juliana, my son Jack, my daughter Jessy'),
('shrutika19newyork@gmail.com', 'Shrutika', 'Gupta', 'Receptionist at Marriot', NULL, '' ),
('xinjiangmao@rocketmail.com', 'Xinjiang', 'Mao', '#Basket ball player', NULL, '3 family members- my mom Sdhiyong, my dad Zianing, my sister Shizuka'),
('iamcooper260@gmail.com', 'Bredly', 'Cooper', 'Hollywood Actor', NULL, 'Everyone knows my family'),
('rahulgarg156989@gmail.com', 'Rahul', 'Garg', 'Computer Science Student at NYU Tandon', NULL, 'my mom- Rashmi, my dad- Rajkumar, my sister- Sheena, my grandfather- Chandra');


insert  into `address`(`uemail`, `ustreet`, `uapt`, `ucity`, `ustate`, `ucountry`, `uzip`) values 
('alex.gordon97@gmail.com', '65th Street', '456', 'Brooklyn', 'New York', 'USA', 11201),
('mike2020@bloomberg.org', '74th Street', '2', 'Manhattan', 'New York', 'USA', 11001),
('elizabethwarren.hbs@yahoo.com', '45th Street', '1223', 'Cambridge','Massachusetts', 'USA', 02138),
('rajeshsharma1975@gmail.com', '65th Street', '457', 'Brookyn', 'New York', 'USA', 11201),
('xiang.zhao956@aol.com', '65th Street', '454', 'Brookyn', 'New York', 'USA', 11201),
('miguel.hernandez@gmail.com', '54th Street', '309', 'Brookyn', 'New York', 'USA', 11209),
('shrutika19newyork@gmail.com', '8th Street', '2121', 'Queens', 'New York', 'USA', 11230),
('xinjiangmao@rocketmail.com', '23th Street', '22', 'Los Angeles', 'California', 'USA', 45082),
('iamcooper260@gmail.com', '1st Street', '788', 'Los Angeles', 'California', 'USA', 45324),
('rahulgarg156989@gmail.com', '88th Street', '34', 'Los Angeles', 'California', 'USA', 45268);


insert  into `neighborhood`(`neighborhood_name`,`nSW_latitude`, `nSW_longitude`, `nNE_latitude`, `nNE_longitude`) values 
('Verazzano', 40.6066, 74.0447, 40.8929, 74.5628),
('Bell Church', 50.2332, 80.2343, 50.4729, 80.3479),
('Golden Market', 34.3242, 90.3322, 34.4654, 90.7808),
('Chinatown', 42.8039, 50.2322, 42.9343, 50.3234),
('Hollwood Town', 30.4978, 70.3434, 30.5323, 70.5523),
('Soho', 44.6756, 74.4354, 44.9403, 74.5643),
('Metropolis', 56.4543, 80.2223, 56.9933, 80.3453);



insert  into `block`(`neighborhood_id`, `block_name`, `bSW_latitude`, `bSW_longitude`, `bNE_latitude`, `bNE_longitude`) values 
(1, 'A', 40.6066, 74.0447, 40.7020, 74.2174),
(1, 'B', 40.7020, 74.2174, 40.7974, 74.3901),
(1, 'C', 40.7974, 75.3901, 40.8929, 74.5628),
(2, 'A', 50.2332, 80.2343, 50.3530, 80.2911),
(2, 'B', 50.3530, 80.2911, 50.4729, 80.3479),
(3, 'A', 34.3242, 90.3322, 34.4654, 90.7808),
(4, 'A', 42.8039, 50.2332, 42.8691, 50.2783),
(4, 'B', 42.8691, 50.2783 ,42.9343, 50.3234),
(5, 'A', 30.4978, 70.3434, 30.5151, 70.4479),
(5, 'B', 30.5151, 70.4479, 30.5323, 70.5523),
(6, 'A', 44.6756, 74.4354, 44.8080, 74.4999),
(6, 'B', 44.8080, 74.4999, 44.9403, 74.5643),
(7, 'A', 56.4543, 80.2223, 56.7238, 80.2838),
(7, 'B', 56.7238, 80.2838, 56.9933, 80.3453);


insert  into `residents`(`uemail`, `neighborhood_id`, `block_id`) values 
('alex.gordon97@gmail.com', 1, 1),
('mike2020@bloomberg.org', 1, 1),
('elizabethwarren.hbs@yahoo.com', 1, 2),
('rajeshsharma1975@gmail.com', 2, 4),
('xiang.zhao956@aol.com', 3, 6),
('miguel.hernandez@gmail.com', 3, 6),
('shrutika19newyork@gmail.com', 3, 6);



insert  into `apply`(`applicant_email`, `neighborhood_id`, `block_id`) values 
('alex.gordon97@gmail.com', 1, 1),
('mike2020@bloomberg.org', 1, 1),
('elizabethwarren.hbs@yahoo.com', 1, 2),
('rajeshsharma1975@gmail.com', 2, 4),
('xiang.zhao956@aol.com', 3, 6),
('miguel.hernandez@gmail.com', 3, 6),
('shrutika19newyork@gmail.com', 3, 6),
('xinjiangmao@rocketmail.com', 3, 6),
('iamcooper260@gmail.com', 1, 1),
('rahulgarg156989@gmail.com', 3, 6);



insert  into `verified`(`applicant_email`, `neighborhood_id`, `block_id`, `verifieremail_1`, `verifieremail_2`, `verifieremail_3`) values 
('rahulgarg156989@gmail.com', 3, 6, 'xiang.zhao956@aol.com', 'miguel.hernandez@gmail.com', 'shrutika19newyork@gmail.com');

insert into friend_request(uemail_1, uemail_2) values
('alex.gordon97@gmail.com', 'mike2020@bloomberg.org'),
('alex.gordon97@gmail.com', 'elizabethwarren.hbs@yahoo.com'),
('mike2020@bloomberg.org', 'elizabethwarren.hbs@yahoo.com');


insert  into `friends`(`uemail_1`, `uemail_2`) values 
('alex.gordon97@gmail.com', 'mike2020@bloomberg.org'),
('alex.gordon97@gmail.com', 'elizabethwarren.hbs@yahoo.com'),
('mike2020@bloomberg.org', 'elizabethwarren.hbs@yahoo.com');


insert  into `direct_neighbors`(`uemail_1`, `uemail_2`) values 
('alex.gordon97@gmail.com', 'rajeshsharma1975@gmail.com'),
('alex.gordon97@gmail.com', 'xiang.zhao956@aol.com'),
('rajeshsharma1975@gmail.com', 'alex.gordon97@gmail.com'),
('rajeshsharma1975@gmail.com', 'xiang.zhao956@aol.com') ;

insert  into `message`(`receiver_type`, `sender_email`, `mthread`, `msubject`, `mtext`) values 
(3, 'alex.gordon97@gmail.com', 'salenearby', 'sale at BM', 'Hi everyone, there is very good sale at the nearby banker market, hope it would be beneficial');

insert  into `message`(`receiver_type`, `sender_email`, `mthread`, `msubject`, `mtext`) values 
(4, 'shrutika19newyork@gmail.com', 'fashion', 'cheapshow', 'cheap tickets available for the fashion show at cheapshowtickets.com');

insert  into `message`(`receiver_type`, `sender_email`, `mthread`, `msubject`, `mtext`) values 
(3, 'shrutika19newyork@gmail.com', 'comedyshow', 'comedy at Gotham', 'Hey, there is a comedy show at Gotham Comedy Club, I am selling my ticket');

insert  into `message`(`receiver_type`, `sender_email`,`friend_neighbor_email`, `mthread`, `msubject`, `mtext`) values 
(1, 'mike2020@bloomberg.org', 'alex.gordon97@gmail.com', 'regarding sale','chair sale', 'Hey, I am selling my Ikea chair, are you interested to buy? It is new.');

insert  into `message`(`receiver_type`, `sender_email`,`friend_neighbor_email`, `mthread`, `msubject`, `mtext`) values 
(2, 'alex.gordon97@gmail.com', 'elizabethwarren.hbs@yahoo.com', 'sale','selling chair', 'Hey, I am selling my Ikea chair, are you interested to buy? It is new.');

insert  into `message`(`receiver_type`, `sender_email`, `mthread`, `msubject`, `mtext`) values 
(3, 'alex.gordon97@gmail.com', 'greatsale','selling table', 'Hey, I am selling my wooden table, if anyone is interested to buying? Reply me');

insert  into `reply`(`responder`, `mthread`, `mtext`) values 
('miguel.hernandez@gmail.com', 'fashion', 'Hey everyone, I can get you all stuffs at cheaper price than sale');

insert  into `reply`(`responder`, `mthread`, `mtext`) values 
('miguel.hernandez@gmail.com', 'comedyshow', 'I am interested in going. What is the price, you are selling your ticket?');

insert  into `reply`(`responder`, `mthread`, `mtext`) values 
('xiang.zhao956@aol.com', 'comedyshow', 'I might want to know the price first and why are you selling your ticket?');

insert  into `reply`(`responder`, `mthread`, `mtext`) values 
('shrutika19newyork@gmail.com', 'fashion', 'I checked everywhere, there is no cheaper price');

insert  into `reply`(`responder`, `mthread`, `mtext`) values 
('mike2020@bloomberg.org', 'greatsale', 'I am interested, please tell the price');

select * from inbox;
select * from reply;

insert  into `logs`(`uemail`) values 
('shrutika19newyork@gmail.com');

update user 
set ubio = 'Hi there, I am from New York. I work as a software engineer',
ufamily = 'We a family of 5- Alex, Mike, Joey, Melania, Jordan'
where uemail = 'alex.gordon97@gmail.com';

select * from message;
select * from signin;
select * from apply;

update user 
set ubio = ' Hi there, I am from New York. I am now financial consultant',
ufamily = 'Alex, Mike, Joey, Melania, Jordan'
where uemail = 'alex.gordon97@gmail.com';
select * from user;

select * from inbox;

update friend_request
set status = 1 where uemail_2 = 'mike2020@bloomberg.org';

Select uemail_2 from friends
Where uemail_1 = 'alex.gordon97@gmail.com';

select * from direct_neighbors;
select * from residents;

select uemail_2 from direct_neighbors
where uemail_1 = 'alex.gordon97@gmail.com';

select * from friends;



insert  into `logs`(`uemail`) values 
('alex.gordon97@gmail.com');

select * from logs order by ltimestamp desc limit 1;
