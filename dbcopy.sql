create database dbproject;

use dbproject;

/*Table structure for table `signin` */
DROP TABLE IF EXISTS `signin`;

CREATE TABLE `signin` (
  `uemail` varchar(30) NOT NULL,
  `upass` varchar(20) NOT NULL,
  PRIMARY KEY (`uemail`)
  );
  
/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `uemail` varchar(30) NOT NULL,
  `ufname` varchar(20) NOT NULL,
  `ulname` varchar(20) NOT NULL,
  `ubio` varchar(100) NOT NULL,
  `upic` blob,
  `ufamily` varchar (100),
  PRIMARY KEY (`uemail`),
  CONSTRAINT `fk_user` FOREIGN KEY (`uemail`) REFERENCES `signin` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE);



/*Table structure for table `address` */

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `uemail` varchar(30) NOT NULL,
  `ustreet` varchar(30) NOT NULL,
  `uapt` varchar(10) NOT NULL,
  `ucity` varchar(15) NOT NULL,
  `ustate` varchar(20) NOT NULL,
  `ucountry` varchar(20) NOT NULL default 'USA',
  `uzip` int(10),
  PRIMARY KEY (`uemail`),
  CONSTRAINT `fk_address` FOREIGN KEY (`uemail`) REFERENCES `user` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE);



/*Table structure for table `neighbourhood` */

DROP TABLE IF EXISTS `neighborhood`;

CREATE TABLE `neighborhood` (
  `neighborhood_id` int(10) NOT NULL auto_increment,
  `neighborhood_name` varchar(20) NOT NULL,
  `nSW_latitude` float NOT NULL,
  `nSW_longitude` float NOT NULL,
  `nNE_latitude` float NOT NULL,
  `nNE_longitude` float NOT NULL,
   PRIMARY KEY (`neighborhood_id`));



/*Table structure for table `block` */

DROP TABLE IF EXISTS `block`;

CREATE TABLE `block` (
  `neighborhood_id` int(10) NOT NULL,
  `block_id` int(10) NOT NULL auto_increment,
  `block_name` varchar(20) NOT NULL,
  `bSW_latitude` float NOT NULL,
  `bSW_longitude` float NOT NULL,
  `bNE_latitude` float NOT NULL,
  `bNE_longitude` float NOT NULL,
   PRIMARY KEY (`block_id`, `neighborhood_id`),
   CONSTRAINT `fk_block` FOREIGN KEY (`neighborhood_id`) REFERENCES `neighborhood` (`neighborhood_id`) ON DELETE CASCADE ON UPDATE CASCADE);



/*Table structure for table `residents` */

DROP TABLE IF EXISTS `residents`;

CREATE TABLE `residents` (
  `uemail` varchar(30) NOT NULL,
  `neighborhood_id` int(10) NOT NULL,
  `block_id` int(10) NOT NULL,
   PRIMARY KEY (`uemail`),
   CONSTRAINT `fk_residents_1` FOREIGN KEY (`uemail`) REFERENCES `address` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_residents_2` FOREIGN KEY (`neighborhood_id`) REFERENCES `block` (`neighborhood_id`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_residents_3` FOREIGN KEY (`block_id`) REFERENCES `block` (`block_id`) ON DELETE CASCADE ON UPDATE CASCADE);


/*Table structure for table `apply` */

DROP TABLE IF EXISTS `apply`;

CREATE TABLE `apply` (
  `applicant_email` varchar(30) NOT NULL,
  `neighborhood_id` int(10) NOT NULL,
  `block_id` int(10) NOT NULL,
   PRIMARY KEY (`applicant_email`, `neighborhood_id`, `block_id`),
   CONSTRAINT `fk_apply_1` FOREIGN KEY (`applicant_email`) REFERENCES `address` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_apply_2` FOREIGN KEY (`neighborhood_id`) REFERENCES `block` (`neighborhood_id`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_apply_3` FOREIGN KEY (`block_id`) REFERENCES `block` (`block_id`) ON DELETE CASCADE ON UPDATE CASCADE);


/*Table structure for table `verified` */

DROP TABLE IF EXISTS `verified`;

CREATE TABLE `verified` (
  `verification_id` int(10) NOT NULL auto_increment,
  `applicant_email` varchar(30) NOT NULL,
  `neighborhood_id` int(10) NOT NULL,
  `block_id` int(10) NOT NULL,
  `verifieremail_1` varchar(30) NOT NULL,
  `verifieremail_2` varchar(30) NOT NULL,
  `verifieremail_3` varchar(30) NOT NULL,
   PRIMARY KEY (`verification_id`),
   CONSTRAINT `fk_verified_1` FOREIGN KEY (`applicant_email`) REFERENCES `apply` (`applicant_email`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_verified_2` FOREIGN KEY (`neighborhood_id`) REFERENCES `apply` (`neighborhood_id`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_verified_3` FOREIGN KEY (`block_id`) REFERENCES `apply` (`block_id`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_verified_4` FOREIGN KEY (`verifieremail_1`) REFERENCES `residents` (`uemail`),
   CONSTRAINT `fk_verified_5` FOREIGN KEY (`verifieremail_2`) REFERENCES `residents` (`uemail`),
   CONSTRAINT `fk_verified_6` FOREIGN KEY (`verifieremail_3`) REFERENCES `residents` (`uemail`));



/*Table structure for table `friends` */

DROP TABLE IF EXISTS `friend_request`;

CREATE TABLE `friend_request` (
  `uemail_1` varchar(30) NOT NULL,
  `uemail_2` varchar(30) NOT NULL,
  `status` boolean default false,
   PRIMARY KEY (`uemail_1`, `uemail_2`),
   CONSTRAINT `fk_friend_request_1` FOREIGN KEY (`uemail_1`) REFERENCES `residents` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_friend_request_2` FOREIGN KEY (`uemail_2`) REFERENCES `residents` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE);


/*Table structure for table `friends` */

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends` (
  `uemail_1` varchar(30) NOT NULL,
  `uemail_2` varchar(30) NOT NULL,
   PRIMARY KEY (`uemail_1`, `uemail_2`),
   CONSTRAINT `fk_friends_1` FOREIGN KEY (`uemail_1`) REFERENCES `residents` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_friends_2` FOREIGN KEY (`uemail_2`) REFERENCES `residents` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE);


/*Table structure for table `direct_neighbours` */

DROP TABLE IF EXISTS `direct_neighbors`;

CREATE TABLE `direct_neighbors` (
  `uemail_1` varchar(30) NOT NULL,
  `uemail_2` varchar(30) NOT NULL,
   PRIMARY KEY (`uemail_1`, `uemail_2`),
   CONSTRAINT `fk_direct_neighbors_1` FOREIGN KEY (`uemail_1`) REFERENCES `residents` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_direct_neighbors_2` FOREIGN KEY (`uemail_2`) REFERENCES `residents` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE);






/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `message_id` int NOT NULL auto_increment,
  `receiver_type` int NOT NULL,
  `friend_neighbor_email` varchar(30),
  `sender_email` varchar(30) NOT NULL,
  `mthread` varchar(30) unique NOT NULL,
  `msubject` varchar(30) unique NOT NULL,
  `mtext` varchar(100) NOT NULL,
  `mtimestamp` timestamp NOT NULL DEFAULT current_timestamp,
   PRIMARY KEY (`message_id`),
   CONSTRAINT `fk_message_1` FOREIGN KEY (`sender_email`) REFERENCES `residents` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE);




/*Table structure for table `reply` */

DROP TABLE IF EXISTS `reply`;

CREATE TABLE `reply` (
  `reply_message_id` int NOT NULL auto_increment,
  `responder` varchar(30) NOT NULL,
  `mthread` varchar(30) NOT NULL,
  `mtext` varchar(100) NOT NULL,
  `mtimestamp` timestamp NOT NULL DEFAULT current_timestamp,
   PRIMARY KEY (`reply_message_id`),
   CONSTRAINT `fk_reply_1` FOREIGN KEY (`responder`) REFERENCES `residents` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE,
   CONSTRAINT `fk_reply_2` FOREIGN KEY (`mthread`) REFERENCES `message` (`mthread`) ON DELETE CASCADE ON UPDATE CASCADE);



/*Table structure for table `inbox` */

DROP TABLE IF EXISTS `inbox`;

CREATE TABLE `inbox` (
  `message_id` int NOT NULL,
  `is_read` int NOT NULL DEFAULT 0,
  `sender_email` varchar(30) NOT NULL,
  `receiver_email` varchar(30) NOT NULL,
  `mthread` varchar(30) NOT NULL,
  `msubject` varchar(30) NOT NULL,
  `mtext` varchar(100) NOT NULL,
  `mtimestamp` timestamp NOT NULL,
   CONSTRAINT `fk_inbox_1` FOREIGN KEY (`receiver_email`) REFERENCES `residents` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE );


/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
`uemail` varchar(30) NOT NULL,
`ltimestamp` timestamp NOT NULL DEFAULT current_timestamp,
CONSTRAINT `fk_logs` FOREIGN KEY (`uemail`) REFERENCES `user` (`uemail`) ON DELETE CASCADE ON UPDATE CASCADE);

delimiter $$
create procedure block_members_message(in message_id int, in sender_email varchar(30),in mthread varchar(20),in msubject varchar(20),in mtext varchar(100),in mtimestamp timestamp)
begin
	DECLARE finished INTEGER DEFAULT 0;
	declare receive_mail varchar(30);
	declare curtmails cursor for
		select uemail from residents where block_id =(
		select block_id from residents where uemail = sender_email)
		and uemail <> sender_email;
        
		DECLARE CONTINUE HANDLER 
		FOR NOT FOUND SET finished = 1;
		open curtmails;
        finalloop: loop
        fetch curtmails into receive_mail;
			IF finished = 1 THEN 
			LEAVE finalloop;
			end if;
			insert  into `inbox`(`message_id`, `sender_email`, `receiver_email`, `mthread`, `msubject`, `mtext`, `mtimestamp`)
			values(message_id,sender_email,receive_mail,mthread,msubject, mtext ,mtimestamp);
		end loop finalloop;
		close curtmails;
end;
$$

delimiter $$
create procedure hood_members_message(in message_id int, in sender_email varchar(30),in mthread varchar(20),in msubject varchar(20),in mtext varchar(100),in mtimestamp timestamp)
begin
DECLARE finished INTEGER DEFAULT 0;
	declare receive_mail varchar(30);
	declare curtmails cursor for
		select uemail from residents where neighborhood_id =(
		select neighborhood_id from residents where uemail = sender_email)
		and uemail <> sender_email;
        
		DECLARE CONTINUE HANDLER 
		FOR NOT FOUND SET finished = 1;
		open curtmails;
        finalloop: loop
        fetch curtmails into receive_mail;
			IF finished = 1 THEN 
			LEAVE finalloop;
			end if;
			insert  into `inbox`(`message_id`, `sender_email`, `receiver_email`, `mthread`, `msubject`, `mtext`, `mtimestamp`)
			values(message_id,sender_email,receive_mail,mthread,msubject, mtext ,mtimestamp);
		end loop finalloop;
		close curtmails;
end;
$$

delimiter $$
create procedure reply_to_inbox(in reply_message_id int, in responder varchar(30), in m1thread varchar(20), in mtext varchar(100), in mtimestamp timestamp)
begin

DECLARE finished INTEGER DEFAULT 0;
	declare receive_mail varchar(30);
    declare m1subject varchar(30);
	declare curtmails cursor for
		select receiver_email as respondants, msubject from inbox i
		where i.mthread= m1thread
        and receiver_email <> responder
        union 
        select distinct sender_email as respondants, msubject from inbox i
		where i.mthread= m1thread;

        
		DECLARE CONTINUE HANDLER 
		FOR NOT FOUND SET finished = 1;
		open curtmails;
        finalloop: loop
        fetch curtmails into receive_mail, m1subject;
			IF finished = 1 THEN 
			LEAVE finalloop;
			end if;
			insert  into `inbox`(`message_id`, `sender_email`, `receiver_email`, `mthread`, `msubject`, `mtext`, `mtimestamp`)
			values(reply_message_id,responder,receive_mail, m1thread, m1subject, mtext ,mtimestamp);
		end loop finalloop;
		close curtmails;
end;
$$

/* Trigger 1 */
create trigger send_message
after insert on message
for each row
begin
if new.receiver_type = 1 or new.receiver_type = 2
then
insert  into `inbox`(`message_id`, `sender_email`, `receiver_email`, `mthread`, `msubject`, `mtext`, `mtimestamp`)
values(new.message_id, new.sender_email, new.friend_neighbor_email, new.mthread , new.msubject, new.mtext , new.mtimestamp );
end if;

if new.receiver_type = 3
then
call block_members_message(new.message_id, new.sender_email,new.mthread , new.msubject, new.mtext , new.mtimestamp );
end if;

if new.receiver_type = 4
then
call hood_members_message(new.message_id, new.sender_email,new.mthread , new.msubject, new.mtext , new.mtimestamp );
end if;
end;
$$


/* Trigger 2 */
delimiter $$
create trigger reply_to_inbox
after insert on
reply
for each row
begin
call reply_to_inbox(new.reply_message_id, new.responder, new.mthread, new.mtext, new.mtimestamp);
end;
$$