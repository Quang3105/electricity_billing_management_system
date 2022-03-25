DELIMITER $$
DROP PROCEDURE IF EXISTS `calcamount`
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `calcamount` (IN `units` INT(14), OUT `result` INT(14))  BEGIN
    DECLARE a INT(14) DEFAULT 0;
    DECLARE b INT(14) DEFAULT 0;
    DECLARE c INT(14) DEFAULT 0;
    DECLARE d INT(14) DEFAULT 0;
    DECLARE e INT(14) DEFAULT 0;
    DECLARE f INT(14) DEFAULT 0;

    SELECT price FROM unitsprice where level = 1 INTO a ;
    SELECT price FROM unitsprice where level = 2 INTO b ;
    SELECT price FROM unitsprice where level = 3 INTO c ;
    SELECT price FROM unitsprice where level = 4 INTO d ;
    SELECT price FROM unitsprice where level = 5 INTO e ;
    SELECT price FROM unitsprice where level = 6 INTO f ;

    IF units<=50
    then
        SELECT a*units INTO result;
    ELSEIF units>50 and units<=100
    then
        SELECT (a*50)+(b*(units-50)) INTO result;
    ELSEIF units > 100 and units <= 200
    then
        SELECT (a*50)+(b*(50))+(c*(units-100)) INTO result;
    ELSEIF units > 200 and units <= 300
    then
        SELECT (a*50)+(b*(50))+(c*(50))+(d*(units-150)) INTO result;
    ELSEIF units > 300 and units <= 400
    then
        SELECT (a*50)+(b*(50))+(c*(50))+(d*(50))+(e*(units-200)) INTO result;
    ELSEIF units > 400
    then
        SELECT (a*50)+(b*(50))+(c*(50))+(d*(50))+(e*(50))+(f*(units-250)) INTO result;
    END IF;

END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `curdate1` () RETURNS INT(11) BEGIN
    DECLARE x INT;
    SET x = DAYOFMONTH(CURDATE());
    IF (x=1)
    THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END$$

DELIMITER ;

CREATE TABLE `admin` (
  `id` int(14) NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender` BIT NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `role` INT(1) NOT NULL,
  `manager_id` INT(14)
);

INSERT INTO `admin` (`id`, `name`, `email`, `gender`, `birthday`, `phone`, `pass`, `address`, `role`, `manager_id`) VALUES
(1, 'Administrator One', 'admin@gmail.com', 1, '2001-02-29', '0911052403', 'Password@123', 'Phố 5', 0, NULL),
(2, 'Administrator Two','admin2@gmail.com', 0, '1999-03-24', '0917885759', 'admin2', 'Phố 7', 0, NULL);


CREATE TABLE `bill` (
  `id` int(14) NOT NULL,
  `aid` int(14) NOT NULL,
  `uid` int(14) NOT NULL,
  `units` int(10) NOT NULL,
  `amount` int(14) NOT NULL,
  `dues` int(14) NOT NULL,
  `pay` int(14) NOT NULL,
  `status` varchar(20) NOT NULL,
  `bdate` date NOT NULL,
  `ddate` date NOT NULL,
  `pdate` date DEFAULT NULL
);

INSERT INTO `bill` (`id`, `aid`, `uid`, `units`, `amount`, `dues`, `pay`, `status`, `bdate`, `ddate`, `pdate`) VALUES
(1, 1, 8, 210, 423460, 0, 423460,  N'Đã thanh toán', '2022-02-10', '2022-03-10', '2022-02-10'),
(2, 1, 1, 61, 102974, 0,  102974, N'Đã thanh toán', '2022-02-10', '2022-03-10', '2022-02-10'),
(3, 1, 2, 78, 132452, 0, 132452, N'Đang chờ', '2022-02-10', '2022-03-10', NULL),
(4, 1, 3, 70, 118580, 0, 118580, N'Chờ duyệt', '2022-02-10', '2022-03-10', '2022-02-10'),
(5, 1, 4, 98, 167132, 0, 167132, N'Chờ duyệt', '2022-02-10', '2022-03-10', '2022-02-10'),
(6, 1, 9, 55, 92570, 0, 92570, N'Chờ duyệt', '2022-02-10', '2022-03-10', '2022-02-10'),
(7, 1, 11, 89, 151526, 0, 151526, N'Đã thanh toán', '2022-02-10', '2022-03-10', '2022-02-10'),
(8, 2, 7, 103, 176642, 0, 151526, N'Đang chờ', '2022-02-10', '2022-03-10', NULL);

-- --------------------------------------------------------

CREATE TABLE `unitsprice` (
  `level` int(1) DEFAULT NULL,
  `price` int(14) NOT NULL
);


INSERT INTO `unitsprice` (`level`, `price`) VALUES
(1, 1678),
(2, 1734),
(3, 2014),
(4, 2536),
(5, 2834),
(6, 2927);

-- --------------------------------------------------------

CREATE TABLE `user` (
  `id` int(14) NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender` BIT NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL
);


INSERT INTO `user` (`id`, `name`, `email`, `gender`, `birthday`, `phone`, `pass`, `address`) VALUES
(1, 'Trần Văn A', 'abc@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 1'),
(2, 'Nguyễn Thị B', 'bac@gmail.com', 0, '2001-05-31', '0123456789', 'password', 'Phố 12'),
(3, 'Cùi Thị C', 'etta@gmail.com', 0, '2001-05-31','0123456789', 'password', 'Phố 11'),
(4, 'Giang Minh D', 'ddd@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 3'),
(5, 'Phạm Trọng E', 'hahaha@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 4'),
(6, 'Trí Hạ F', 'fff@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 11'),
(7, 'Lại Thế G', 'ggg@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 20'),
(8, 'Giang Sang H', 'hhh@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 19'),
(9, 'Trần Mỹ L', 'lll@gmail.com', 0, '2001-05-31', '0123456789', 'password', 'Phố 18'),
(10, 'Hạ Thị M', 'mmm@gmail.com', 0, '2001-05-31', '0123456789', 'password', 'Phố 5'),
(11, 'Lê Minh N', 'nnn@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 7');

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aid` (`aid`),
  ADD KEY `uid` (`uid`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `bill`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
  
ALTER TABLE `user`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `admin`
  ADD CONSTRAINT `FK_manager` FOREIGN KEY (`manager_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `bill`
  ADD CONSTRAINT `FK_adminbill` FOREIGN KEY (`aid`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_userbill` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
