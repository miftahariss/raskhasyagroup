-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 28 Agu 2016 pada 01.57
-- Versi Server: 5.5.47-0ubuntu0.14.04.1
-- Versi PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `raskhasyagroup`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `short_desc` tinytext NOT NULL,
  `body` text,
  `filename` varchar(125) NOT NULL,
  `permalink` varchar(120) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` tinyint(2) DEFAULT NULL,
  `modified_by` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0=inactive; 1=active; 2=draft; default=1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `title`, `short_desc`, `body`, `filename`, `permalink`, `created_date`, `modified_date`, `created_by`, `modified_by`, `status`) VALUES
(1, 'ARSITEKTUR', 'ARSITEKTUR', '<p>ARSITEKTUR</p>\n', '1472227865.jpg', 'arsitektur', 1472114280, 1472227865, 1, 1, 1),
(2, 'SIPIL', 'SIPIL', '<p>SIPIL</p>\n', '1472225800.jpg', 'sipil', 1472225699, 1472225801, 1, 1, 1),
(3, 'ALAT BERAT & PENDUKUNG', 'ALAT BERAT & PENDUKUNG', '<p>ALAT BERAT &amp; PENDUKUNG</p>\n', '1472225784.jpg', 'alat-berat-pendukung', 1472225784, NULL, 1, NULL, 1),
(4, 'MATERIAL', 'MATERIAL', '<p>MATERIAL</p>\n', '1472225818.jpg', 'material', 1472225818, NULL, 1, NULL, 1),
(5, 'TEKNOLOGI', 'TEKNOLOGI', '<p>TEKNOLOGI</p>\n', '1472225832.jpg', 'teknologi', 1472225832, NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_counter`
--

CREATE TABLE IF NOT EXISTS `category_counter` (
  `counter_category_id` int(20) NOT NULL,
  `counter_count` int(11) NOT NULL,
  `counter_count_date` date NOT NULL,
  PRIMARY KEY (`counter_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `category_counter`
--

INSERT INTO `category_counter` (`counter_category_id`, `counter_count`, `counter_count_date`) VALUES
(1, 15, '2016-08-28'),
(5, 4, '2016-08-28'),
(4, 4, '2016-08-28'),
(3, 5, '2016-08-28'),
(2, 6, '2016-08-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `short_desc` tinytext NOT NULL,
  `body` text,
  `filename` varchar(125) NOT NULL,
  `permalink` varchar(120) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` tinyint(2) DEFAULT NULL,
  `modified_by` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0=inactive; 1=active; 2=draft; default=1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `title`, `short_desc`, `body`, `filename`, `permalink`, `created_date`, `modified_date`, `created_by`, `modified_by`, `status`) VALUES
(1, 'kegiatan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa quo nihil iure, veritatis inventore eligendi aut neque pariatur sed aliquid. Magnam temporibus ea porro eum aperiam doloremque.', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\n\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\n\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\n\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\n', '1472244451.jpg', 'kegiatan', 1472244451, 1472296905, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_counter`
--

CREATE TABLE IF NOT EXISTS `kegiatan_counter` (
  `counter_kegiatan_id` int(20) NOT NULL,
  `counter_count` int(11) NOT NULL,
  `counter_count_date` date NOT NULL,
  PRIMARY KEY (`counter_kegiatan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kegiatan_counter`
--

INSERT INTO `kegiatan_counter` (`counter_kegiatan_id`, `counter_count`, `counter_count_date`) VALUES
(1, 3, '2016-08-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
--

CREATE TABLE IF NOT EXISTS `mitra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `short_desc` tinytext NOT NULL,
  `body` text,
  `filename` varchar(125) NOT NULL,
  `permalink` varchar(120) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` tinyint(2) DEFAULT NULL,
  `modified_by` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0=inactive; 1=active; 2=draft; default=1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `mitra`
--

INSERT INTO `mitra` (`id`, `title`, `short_desc`, `body`, `filename`, `permalink`, `created_date`, `modified_date`, `created_by`, `modified_by`, `status`) VALUES
(1, 'mitra', 'mitra', '<p>mitra</p>\n', '1472240692.png', 'mitra', 1472240692, NULL, 1, NULL, 1),
(2, 'mitra2', 'mitra2', '<p>mitra2</p>\n', '1472244436.png', 'mitra2', 1472244354, 1472244436, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `short_desc` tinytext NOT NULL,
  `body` text,
  `filename` varchar(125) NOT NULL,
  `permalink` varchar(120) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` tinyint(2) DEFAULT NULL,
  `modified_by` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0=inactive; 1=active; 2=draft; default=1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `id_category`, `title`, `short_desc`, `body`, `filename`, `permalink`, `created_date`, `modified_date`, `created_by`, `modified_by`, `status`) VALUES
(1, 1, 'product1', 'product1', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\n\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\n\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\n\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\n', '1472282289.jpg', 'product1', 1472115903, 1472296352, 1, 1, 1),
(2, 1, 'product 2', 'product 2', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\n\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\n\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\n\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\n', '1472281755.jpg', 'product-2', 1472281755, 1472296341, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_counter`
--

CREATE TABLE IF NOT EXISTS `product_counter` (
  `counter_product_id` int(20) NOT NULL,
  `counter_count` int(11) NOT NULL,
  `counter_count_date` date NOT NULL,
  PRIMARY KEY (`counter_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `product_counter`
--

INSERT INTO `product_counter` (`counter_product_id`, `counter_count`, `counter_count_date`) VALUES
(2, 4, '2016-08-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` tinyint(2) DEFAULT NULL,
  `modified_by` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0=inactive; 1=active; 2=draft; default=1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id`, `title`, `body`, `created_date`, `modified_date`, `created_by`, `modified_by`, `status`) VALUES
(1, 'Raskhasya Group', '<p class="mb10">Merupakan sebuah group yg terdiri dari para Arsitek, Ahli Sipil, Konsultan Perencana dan Konsultan Pengawas, Owner dari pemilik alat berat, Pemilik alat pendukung pekerjaan Konstruksi, Pemilik Precast, Pemilik Paving Block, Pemilik AMP Aspalt, Supplier Besar Readymix, Material Bangunan dan para tukang yang sudah profesional.</p>\n\n                        <p class="mb10">Group ini bergabung dengan tujuan untuk mempermudah pekerjaan kami, mempermudah pekerjaan pemerintah dan mempermudah pekerjaan para klien kami.</p>\n\n                        <p class="mb10">Bergabungnya kami dalam satu group akan memberikan dampak luar biasa pada kwalitas pekerjaan yang dipercayakan kepada kami. Dan dengan biaya yang lebih baik bagi semua rekanan kami.</p>', 1472225784, 1472242252, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  `filename` varchar(125) NOT NULL,
  `permalink` varchar(120) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `created_date` int(11) NOT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `created_by` tinyint(2) DEFAULT NULL,
  `modified_by` tinyint(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0=inactive; 1=active; 2=draft; default=1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id`, `title`, `link`, `filename`, `permalink`, `order_number`, `created_date`, `modified_date`, `created_by`, `modified_by`, `status`) VALUES
(1, 'slide 1', '', '1472239622.jpg', 'slide-1', '1', 1472239622, NULL, 1, NULL, 1),
(2, 'slider 2', '', '1472239670.jpg', 'slider-2', '2', 1472239671, NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_date` int(11) DEFAULT NULL,
  `modified_date` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `role` tinyint(1) DEFAULT NULL COMMENT '1: administrator; 2: editor',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `created_date`, `modified_date`, `status`, `role`) VALUES
(1, 'autobacs', 'admin@autobacs.co.id', 'cfe31d9429703a311e592789acec8b0da1e4ab90', 0, 1447055705, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
