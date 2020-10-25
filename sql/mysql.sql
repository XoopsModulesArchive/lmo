# phpMyAdmin MySQL-Dump
# version 2.2.3
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `lmo_conf`
#

CREATE TABLE lmo_conf (
    conf_id      INT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
    LeagueDir    VARCHAR(60)              DEFAULT NULL,
    PktJustify   INT(3)          NOT NULL DEFAULT '0',
    TabOnResults INT(3)          NOT NULL DEFAULT '0',
    TippMitReg   INT(3)          NOT NULL DEFAULT '0',
    BackLink     INT(3)          NOT NULL DEFAULT '0',
    CalcTime     INT(3)          NOT NULL DEFAULT '0',
    DefaultTime  TINYTEXT        NOT NULL,
    AdminMail    VARCHAR(50)              DEFAULT NULL,
    PRIMARY KEY (conf_id)
)
    ENGINE = ISAM;
#
# Daten für Tabelle `lmo_conf`
#

INSERT INTO lmo_conf
VALUES (1, 'ligen/', 1, 2, 1, 1, 0, '15:30', 'webmaster@service.bama-webdesign.de');


# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `lmo_helfer`
#

CREATE TABLE lmo_helfer (
    id      INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    uid_lmo INT(5)          NOT NULL DEFAULT '0',
    ligen   TEXT            NOT NULL,
    PRIMARY KEY (id)
)
    ENGINE = ISAM;
