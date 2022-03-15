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


CREATE TABLE `bill` (
  `id` int(14) NOT NULL,
  `aid` int(14) NOT NULL,
  `uid` int(14) NOT NULL,
  `units` int(10) NOT NULL,
  `amount` int(14) NOT NULL,
  `status` varchar(20) NOT NULL,
  `bdate` date NOT NULL,
  `ddate` date NOT NULL
);

INSERT INTO `bill` (`id`, `aid`, `uid`, `units`, `amount`, `status`, `bdate`, `ddate`) VALUES
(1, 12, 8, 210, '423460', N'Đã thanh toán', '2022-02-10', '2022-03-10'),
(2, 12, 1, 61, '102974', N'Đã thanh toán', '2022-02-10', '2022-03-10'),
(3, 12, 2, 78, '132452', N'Đang chờ', '2022-02-10', '2022-03-10'),
(4, 12, 3, 70, '118580', N'Chờ duyệt', '2022-02-10', '2022-03-10'),
(5, 12, 4, 98, '167132', N'Chờ duyệt', '2022-02-10', '2022-03-10'),
(6, 12, 9, 55, '92570', N'Chờ duyệt', '2022-02-10', '2022-03-10'),
(7, 12, 11, 89, '151526', N'Đã thanh toán', '2022-02-10', '2022-03-10'),
(8, 12, 7, 103, '176642', N'Đang chờ', '2022-02-10', '2022-03-10');

-- --------------------------------------------------------

CREATE TABLE `transaction` (
  `id` int(14) NOT NULL,
  `bid` int(14) NOT NULL,
  `payable` int(14) NOT NULL,
  `pdate` date DEFAULT NULL,
  `status` varchar(20) NOT NULL
);


INSERT INTO `transaction` (`id`, `bid`, `payable`, `pdate`, `status`) VALUES
(1, 1, '423460', '2022-02-10', N'Đã thanh toán'),
(2, 2, '102974', '2022-02-10', N'Đã thanh toán'),
(3, 3, '132452', NULL, N'Đang chờ'),
(4, 4, '118580', '2022-02-10', N'Chờ duyệt'),
(5, 5, '167132', NULL, N'Chờ duyệt'),
(6, 6, '92570', '2022-02-10', N'Đã thanh toán'),
(7, 7, '151526', '2022-02-10', N'Đã thanh toán'),
(8, 8, '176642', NULL, N'Đang chờ');

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
  `address` varchar(100) NOT NULL,
  `status` INT(1) NOT NULL
);


INSERT INTO `user` (`id`, `name`, `email`, `gender`, `birthday`, `phone`, `pass`, `address`, `status`) VALUES
(1, 'Trần Văn A', 'abc@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 1', 2),
(2, 'Nguyễn Thị B', 'bac@gmail.com', 0, '2001-05-31', '0123456789', 'password', 'Phố 12', 2),
(3, 'Cùi Thị C', 'etta@gmail.com', 0, '2001-05-31','0123456789', 'password', 'Phố 11', 2),
(4, 'Giang Minh D', 'ddd@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 3', 2),
(5, 'Phạm Trọng E', 'hahaha@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 4', 2),
(6, 'Eric Webb', 'ericw@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 11', 2),
(7, 'Jonathan Lasalle', 'jonathan@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 20', 2),
(8, 'Liam Moore', 'liamoore@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 19', 2),
(9, 'Will Williams', 'williams@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 18', 2),
(10, 'Christine Moore', 'moore@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 5', 2),
(11, 'Timothy Diaz', 'timothy@gmail.com', 1, '2001-05-31', '0123456789', 'password', 'Phố 7', 2),
(12, 'Administrator One', 'admin@gmail.com', 1, '2001-02-29', '0911052403', 'Password@123', 'Phố 5', 0),
(13, 'Administrator Two','admin2@gmail.com', 0, '1999-03-24', '0917885759', 'admin2', 'Phố 7', 0);


ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aid` (`aid`),
  ADD KEY `uid` (`uid`);

ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bid` (`bid`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bill`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `transaction`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `user`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `bill`
  ADD CONSTRAINT `FK_userbill` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_transbill` FOREIGN KEY (`bid`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

