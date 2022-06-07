DELIMITER $$

USE `data_kampus`$$

DROP PROCEDURE IF EXISTS `tabelMahasiswa`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tabelMahasiswa`()
BEGIN
    SELECT nama, alamat, jurusan, nilai_ipk,
    CASE
    WHEN nilai_ipk >= 2.00 AND nilai_ipk <= 2.75 THEN 'Memuaskan'
        WHEN nilai_ipk > 2.75 AND nilai_ipk <= 3.50 THEN 'Sangat Memuaskan'
        WHEN nilai_ipk > 3.50 AND nilai_ipk <= 4.00 THEN 'Cum Laude'
    END AS grade
    FROM mahasiswa;
END$$

DELIMITER ;