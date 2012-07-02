--
-- CREATE adm2rest_access
--
CREATE TABLE IF NOT EXISTS `adm2rest_access` (
  `OXID` char(32) COLLATE latin1_general_ci NOT NULL,
  `OXAPIACCESSKEY` char(32) COLLATE latin1_general_ci NOT NULL,
  `OXACCESSTOKEN` char(50) COLLATE latin1_general_ci NOT NULL,
  `OXTIMETOEXPIRE` int(11) NOT NULL,
  `OXUPDATE` int(11) NOT NULL,
  PRIMARY KEY (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


--
-- CREATE adm2rest_api
--
CREATE TABLE IF NOT EXISTS `adm2rest_api` (
  `OXID` char(32) COLLATE latin1_general_ci NOT NULL,
  `OXUSERID` char(32) COLLATE latin1_general_ci NOT NULL,
  `OXAPIACCESS` tinyint(1) NOT NULL,
  `OXAPIACCESSKEY` char(50) COLLATE latin1_general_ci NOT NULL,
  `OXUPDATE` int(11) NOT NULL,
  PRIMARY KEY (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
