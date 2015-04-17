-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2015 at 12:11 AM
-- Server version: 5.5.41-cll-lve
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `raovat_thangbom`
--

-- --------------------------------------------------------

--
-- Table structure for table `raovat_actions`
--

CREATE TABLE IF NOT EXISTS `raovat_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(63) DEFAULT NULL,
  `controller_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;

--
-- Dumping data for table `raovat_actions`
--

INSERT INTO `raovat_actions` (`id`, `action_name`, `controller_id`) VALUES
(1, 'view', 77),
(2, 'create', 77),
(3, 'update', 77),
(4, 'delete', 77),
(5, 'index', 77),
(6, 'error', 78),
(7, 'view', 78),
(8, 'view', 79),
(9, 'create', 79),
(10, 'update', 79),
(11, 'delete', 79),
(12, 'index', 79),
(13, 'view', 80),
(14, 'create', 80),
(15, 'update', 80),
(16, 'delete', 80),
(17, 'index', 80),
(18, 'index', 81),
(19, 'listproblem', 81),
(20, 'listspecialty', 81),
(21, 'index', 82),
(22, 'unsubscribe', 82),
(23, 'error', 82),
(24, 'contact', 82),
(25, 'thankyou', 82),
(26, 'guestsubscriber', 82),
(27, 'underconstruction', 82),
(28, 'test', 82),
(29, 'view', 83),
(30, 'create', 83),
(31, 'update', 83),
(32, 'delete', 83),
(33, 'index', 83),
(34, 'admin', 83),
(35, 'ajaxactivate', 83),
(36, 'ajaxdeactivate', 83),
(37, 'ajaxshow', 83),
(38, 'ajaxnotshow', 83),
(39, 'ajaxapprove', 83),
(40, 'view', 84),
(41, 'create', 84),
(42, 'update', 84),
(43, 'delete', 84),
(44, 'index', 84),
(45, 'ajaxactivate', 84),
(46, 'ajaxdeactivate', 84),
(47, 'ajaxshow', 84),
(48, 'ajaxnotshow', 84),
(49, 'ajaxapprove', 84),
(50, 'view', 85),
(51, 'create', 85),
(52, 'update', 85),
(53, 'delete', 85),
(54, 'index', 85),
(55, 'ajaxactivate', 85),
(56, 'ajaxdeactivate', 85),
(57, 'ajaxshow', 85),
(58, 'ajaxnotshow', 85),
(59, 'ajaxapprove', 85),
(60, 'view', 86),
(61, 'create', 86),
(62, 'update', 86),
(63, 'delete', 86),
(64, 'index', 86),
(65, 'uploadfile', 86),
(66, 'ajaxactivate', 86),
(67, 'ajaxdeactivate', 86),
(68, 'ajaxshow', 86),
(69, 'ajaxnotshow', 86),
(70, 'ajaxapprove', 86),
(71, 'view', 87),
(72, 'create', 87),
(73, 'update', 87),
(74, 'delete', 87),
(75, 'index', 87),
(76, 'ajaxactivate', 87),
(77, 'ajaxdeactivate', 87),
(78, 'ajaxshow', 87),
(79, 'ajaxnotshow', 87),
(80, 'ajaxapprove', 87),
(81, 'view', 88),
(82, 'create', 88),
(83, 'update', 88),
(84, 'delete', 88),
(85, 'index', 88),
(86, 'admin', 88),
(87, 'ajaxactivate', 88),
(88, 'ajaxdeactivate', 88),
(89, 'ajaxshow', 88),
(90, 'ajaxnotshow', 88),
(91, 'ajaxapprove', 88),
(92, 'getactionsname', 89),
(93, 'test', 89),
(94, 'index', 89),
(95, 'view', 90),
(96, 'create', 90),
(97, 'update', 90),
(98, 'delete', 90),
(99, 'index', 90),
(100, 'update_my_profile', 90),
(101, 'change_my_password', 90),
(102, 'ajaxactivate', 90),
(103, 'ajaxdeactivate', 90),
(104, 'ajaxshow', 90),
(105, 'ajaxnotshow', 90),
(106, 'ajaxapprove', 90),
(107, 'view', 91),
(108, 'help', 91),
(109, 'update', 91),
(110, 'addcustomphoto', 91),
(111, 'choosemodel', 91),
(112, 'delete', 91),
(113, 'index', 91),
(114, 'handlecropzoom', 91),
(115, 'ajaxactivate', 91),
(116, 'ajaxdeactivate', 91),
(117, 'ajaxshow', 91),
(118, 'ajaxnotshow', 91),
(119, 'ajaxapprove', 91),
(120, 'exportexcel', 92),
(121, 'view', 92),
(122, 'create', 92),
(123, 'update', 92),
(124, 'delete', 92),
(125, 'index', 92),
(126, 'ajaxactivate', 92),
(127, 'ajaxdeactivate', 92),
(128, 'ajaxshow', 92),
(129, 'ajaxnotshow', 92),
(130, 'ajaxapprove', 92),
(131, 'view', 93),
(132, 'create', 93),
(133, 'update', 93),
(134, 'delete', 93),
(135, 'index', 93),
(136, 'ajaxactivate', 93),
(137, 'ajaxdeactivate', 93),
(138, 'ajaxshow', 93),
(139, 'ajaxnotshow', 93),
(140, 'ajaxapprove', 93),
(141, 'create', 94),
(142, 'view', 94),
(143, 'update', 94),
(144, 'delete', 94),
(145, 'index', 94),
(146, 'ajaxactivate', 94),
(147, 'ajaxdeactivate', 94),
(148, 'ajaxshow', 94),
(149, 'ajaxnotshow', 94),
(150, 'ajaxapprove', 94),
(151, 'view', 95),
(152, 'create', 95),
(153, 'update', 95),
(154, 'delete', 95),
(155, 'index', 95),
(156, 'ajaxactivate', 95),
(157, 'ajaxdeactivate', 95),
(158, 'ajaxshow', 95),
(159, 'ajaxnotshow', 95),
(160, 'ajaxapprove', 95),
(161, 'view', 96),
(162, 'create', 96),
(163, 'update', 96),
(164, 'delete', 96),
(165, 'index', 96),
(166, 'ajaxactivate', 96),
(167, 'ajaxdeactivate', 96),
(168, 'ajaxshow', 96),
(169, 'ajaxnotshow', 96),
(170, 'ajaxapprove', 96),
(171, 'view', 97),
(172, 'create', 97),
(173, 'addroles', 97),
(174, 'update', 97),
(175, 'viewroles', 97),
(176, 'delete', 97),
(177, 'index', 97),
(178, 'admin', 97),
(179, 'ajaxactivate', 97),
(180, 'ajaxdeactivate', 97),
(181, 'ajaxshow', 97),
(182, 'ajaxnotshow', 97),
(183, 'ajaxapprove', 97),
(184, 'update', 98),
(185, 'index', 98),
(186, 'ajaxactivate', 98),
(187, 'ajaxdeactivate', 98),
(188, 'ajaxshow', 98),
(189, 'ajaxnotshow', 98),
(190, 'ajaxapprove', 98),
(191, 'forgotpassword', 99),
(192, 'resetpassword', 99),
(193, 'changepassword', 99),
(194, 'error', 99),
(195, 'index', 99),
(196, 'login', 99),
(197, 'logout', 99),
(198, 'ajaxactivate', 99),
(199, 'ajaxdeactivate', 99),
(200, 'ajaxshow', 99),
(201, 'ajaxnotshow', 99),
(202, 'ajaxapprove', 99),
(203, 'view', 100),
(204, 'create', 100),
(205, 'update', 100),
(206, 'delete', 100),
(207, 'index', 100),
(208, 'ajaxactivate', 100),
(209, 'ajaxdeactivate', 100),
(210, 'ajaxshow', 100),
(211, 'ajaxnotshow', 100),
(212, 'ajaxapprove', 100),
(213, 'view', 101),
(214, 'create', 101),
(215, 'update', 101),
(216, 'delete', 101),
(217, 'index', 101),
(218, 'ajaxactivate', 101),
(219, 'ajaxdeactivate', 101),
(220, 'ajaxshow', 101),
(221, 'ajaxnotshow', 101),
(222, 'ajaxapprove', 101);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_actions_roles`
--

CREATE TABLE IF NOT EXISTS `raovat_actions_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles_id` int(11) DEFAULT NULL,
  `controller_id` int(11) DEFAULT NULL,
  `actions` varchar(1000) DEFAULT NULL,
  `can_access` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `can_access` (`can_access`),
  KEY `controller_id` (`controller_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=350 ;

--
-- Dumping data for table `raovat_actions_roles`
--

INSERT INTO `raovat_actions_roles` (`id`, `roles_id`, `controller_id`, `actions`, `can_access`) VALUES
(50, 2, 106, 'View, Create, Update, Delete, List, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(51, 2, 107, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(52, 2, 108, 'View, Create, Update, Delete, Index, Admin, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(53, 2, 109, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(54, 2, 110, 'UpdateLeftScrollBanner,UpdateRightScrollBanner,UpdateTopBannerLeft,UpdateTopBannerRight,Create,Delete,Index,SaveBannerItems,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(55, 2, 111, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(56, 2, 112, 'View, Create, Update, Delete, Index, UploadFile, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(57, 2, 113, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(58, 2, 114, 'View, Edit, Create, Update, Delete, Index, Group, User, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove,GetControllerList, GetAvailableAction', 'allow'),
(59, 2, 115, 'View,Create,Update,Invoice,Delete,Index,Admin,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove', 'allow'),
(60, 2, 116, 'GetActionsName, RolesSession, Test, Index', 'allow'),
(61, 2, 117, 'View,Create,Update,Delete,DeleteAll,Index,Update_my_profile,Change_my_password,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(62, 2, 118, 'View, Help, Update, AddCustomPhoto, ChooseModel, Delete, Index, HandleCropZoom, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(63, 2, 119, 'Create,Delete,Index,Update,View,DeleteAll,MemberToDownload,Create_member,Update_member,View_member,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(64, 2, 120, 'View,Create,Getcheckbox,Update,Delete,Index,GetControllerList,GetActionList,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove', 'allow'),
(65, 2, 121, 'Create, View, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(66, 2, 122, 'View, Create, Imagepaging, Imageurl, Imageupload, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove, DeleteAll, RemoveImage', 'allow'),
(67, 2, 123, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(68, 2, 124, 'View, Create, Update, Delete, Index, AddCategory, GetDropdownCategory, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(69, 2, 125, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(70, 2, 126, 'View, Create, AddRoles, Update, ViewRoles, Delete, Index, Admin, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(71, 2, 127, 'Update, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(72, 2, 128, 'ForgotPassword, ResetPassword, ChangePassword, Error, Index, Login, Logout, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(73, 2, 129, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(74, 2, 130, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(75, 2, 131, 'Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(76, 2, 132, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(77, 2, 133, 'Error, View', 'allow'),
(78, 2, 134, 'Index, ListProblem, ListSpecialty', 'allow'),
(79, 2, 135, 'Index, Unsubscribe, Error, Contact, ThankYou, GuestSubscriber, UnderConstruction, Test', 'allow'),
(81, 1, 106, 'View, Create, Update, Delete, List, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(82, 1, 107, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(83, 1, 108, 'View, Create, Update, Delete, Index, Admin, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(84, 1, 109, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(85, 1, 110, 'UpdateLeftScrollBanner,UpdateRightScrollBanner,UpdateTopBannerLeft,UpdateTopBannerRight,Create,Delete,Index,SaveBannerItems,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(86, 1, 111, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(87, 1, 112, 'View, Create, Update, Delete, Index, UploadFile, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(88, 1, 113, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(89, 1, 114, 'View, Edit, Create, Update, Delete, Index, Group, User, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove, GetControllerList,GetAvailableAction', 'allow'),
(90, 1, 115, 'View,Create,Update,Invoice,Delete,Index,Admin,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove', 'allow'),
(91, 1, 116, 'GetActionsName, RolesSession, Test, Index', 'allow'),
(92, 1, 117, 'View,Create,Update,Delete,DeleteAll,Index,Update_my_profile,Change_my_password,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(93, 1, 118, 'View, Help, Update, AddCustomPhoto, ChooseModel, Delete, Index, HandleCropZoom, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(94, 1, 119, 'Create,Delete,Index,Update,View,DeleteAll,MemberToDownload,Create_member,Update_member,View_member,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(95, 1, 120, 'View,Create,Getcheckbox,Update,Delete,Index,GetControllerList,GetActionList,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove', 'allow'),
(96, 1, 121, 'Create, View, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(97, 1, 122, 'View, Create, Imagepaging, Imageurl, Imageupload, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove, DeleteAll, RemoveImage', 'allow'),
(98, 1, 123, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(99, 1, 124, 'View, Create, Update, Delete, Index, AddCategory, GetDropdownCategory, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(100, 1, 125, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(101, 1, 126, 'View, Create, AddRoles, Update, ViewRoles, Delete, Index, Admin, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(102, 1, 127, 'Update, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove, SendTestMail', 'allow'),
(103, 1, 128, 'ForgotPassword, ResetPassword, ChangePassword, Error, Index, Login, Logout, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(104, 1, 129, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(105, 1, 130, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(106, 1, 131, 'Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(107, 1, 132, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(108, 1, 133, 'Error, View', 'allow'),
(109, 1, 134, 'Index, ListProblem, ListSpecialty', 'allow'),
(110, 1, 135, 'Index, Unsubscribe, Error, Contact, ThankYou, GuestSubscriber, UnderConstruction, Test', 'allow'),
(112, 1, 114, '', 'deny'),
(113, 2, 114, '', 'deny'),
(114, 1, 139, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(115, 1, 139, '', 'deny'),
(118, 2, 139, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(119, 2, 139, '', 'deny'),
(120, 2, 140, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(121, 2, 140, '', 'deny'),
(122, 1, 122, '', 'deny'),
(123, 2, 122, '', 'deny'),
(124, 1, 120, '', 'deny'),
(125, 2, 120, '', 'deny'),
(126, 1, 141, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(127, 1, 141, '', 'deny'),
(128, 2, 141, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(129, 2, 141, '', 'deny'),
(130, 1, 142, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(131, 1, 142, '', 'deny'),
(132, 1, 143, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(133, 1, 143, '', 'deny'),
(134, 2, 143, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(135, 2, 143, '', 'deny'),
(136, 1, 144, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(137, 1, 144, '', 'deny'),
(138, 2, 144, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(139, 2, 144, '', 'deny'),
(140, 2, 110, '', 'deny'),
(141, 2, 142, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(142, 2, 142, '', 'deny'),
(143, 1, 145, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(144, 1, 145, '', 'deny'),
(145, 2, 145, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(146, 2, 145, '', 'deny'),
(147, 1, 146, 'Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(148, 1, 146, '', 'deny'),
(149, 2, 146, 'Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(150, 2, 146, '', 'deny'),
(151, 1, 124, '', 'deny'),
(152, 2, 124, '', 'deny'),
(153, 2, 148, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(154, 2, 148, '', 'deny'),
(155, 1, 148, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(156, 1, 148, '', 'deny'),
(157, 2, 127, '', 'deny'),
(158, 1, 127, '', 'deny'),
(159, 2, 149, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(160, 2, 149, '', 'deny'),
(161, 2, 150, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(162, 2, 150, '', 'deny'),
(163, 2, 151, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(164, 2, 151, '', 'deny'),
(165, 2, 152, 'Index, Rendernewitem, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(166, 2, 152, '', 'deny'),
(167, 2, 153, 'View, Create, Update, Delete, Index, Admin, Approve, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(168, 2, 153, '', 'deny'),
(169, 1, 153, 'View, Create, Update, Delete, Index, Admin, Approve, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(170, 1, 153, '', 'deny'),
(171, 2, 154, 'Create, Delete, Index, Update, View, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(172, 2, 154, '', 'deny'),
(173, 2, 155, 'View, Create, Update, Delete, Index, Up, Down, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(174, 2, 155, '', 'deny'),
(175, 2, 156, 'View, Create, Update, Delete, Index, Update_my_profile, Change_my_password, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(176, 2, 156, '', 'deny'),
(177, 1, 157, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(178, 1, 157, '', 'deny'),
(179, 2, 157, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(180, 2, 157, '', 'deny'),
(181, 1, 119, '', 'deny'),
(182, 1, 158, 'Create,Delete,Index,Update,View,DeleteAll,Rendernewitem,Rendernewpageitem,RemoveMenuItem,GetLinkInputHtml,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(183, 2, 158, 'Create,Delete,Index,Update,View,DeleteAll,Rendernewitem,Rendernewpageitem,RemoveMenuItem,GetLinkInputHtml,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(184, 1, 159, 'Create,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove', 'allow'),
(185, 2, 159, 'Create,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove', 'allow'),
(186, 1, 160, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove', 'allow'),
(187, 2, 160, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove', 'allow'),
(188, 1, 161, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(189, 2, 161, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(190, 1, 162, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(191, 2, 162, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(192, 1, 163, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(193, 2, 163, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(194, 1, 164, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(195, 2, 164, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(196, 1, 165, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(197, 2, 165, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(198, 1, 166, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(199, 2, 166, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(200, 1, 167, 'Create,Delete,Index,Update,View,DeleteAll,History,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(201, 2, 167, 'Create,Delete,Index,Update,View,DeleteAll,History,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(202, 1, 168, 'Create,Delete,Index,Update,View,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(203, 2, 168, 'Create,Delete,Index,Update,View,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(204, 1, 169, 'Create,Delete,Index,SaveBannerItems,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(205, 2, 169, 'Create,Delete,Index,SaveBannerItems,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(206, 1, 170, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(207, 2, 170, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(208, 1, 171, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(209, 2, 171, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(210, 1, 172, 'AjaxApprove,AjaxReject,AutoCompleteName,Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,RemoveImage,RemoveFile', 'allow'),
(211, 2, 172, 'AjaxApprove,AjaxReject,AutoCompleteName,Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,RemoveImage,RemoveFile', 'allow'),
(212, 1, 173, 'Create,Delete,Index,Uploaddoc,Uploadtitle,Deletedoc,Update,View,DeleteAll,AjaxApprove,AjaxReject,Uploadavatar,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,RemoveImage,RemoveFile', 'allow'),
(213, 2, 173, 'Create,Delete,Index,Uploaddoc,Uploadtitle,Deletedoc,Update,View,DeleteAll,AjaxApprove,AjaxReject,Uploadavatar,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,RemoveImage,RemoveFile', 'allow'),
(214, 1, 174, 'Create,Delete,Index,Update,View,AjaxApprove,AjaxReject,Loademail,Sendemail,Apply,Searchtutor,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,RemoveImage,RemoveFile', 'allow'),
(215, 2, 174, 'Create,Delete,Index,Update,View,AjaxApprove,AjaxReject,Loademail,Sendemail,Apply,Searchtutor,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,RemoveImage,RemoveFile', 'allow'),
(216, 1, 175, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(217, 2, 175, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(218, 1, 176, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(219, 2, 176, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(220, 1, 177, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(221, 2, 177, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(222, 1, 178, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(223, 2, 178, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(224, 1, 179, 'Create,Delete,Index,Update,View,DeleteAll,AjaxPaid,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(225, 2, 179, 'Create,Delete,Index,Update,View,DeleteAll,AjaxPaid,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(226, 1, 180, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(227, 2, 180, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(228, 1, 181, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(229, 2, 181, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(230, 1, 182, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(231, 2, 182, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(232, 1, 183, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(233, 2, 183, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(234, 1, 184, 'Index,Create,Update,View,AjaxActivate,AjaxDeactivate,CreatePageBanner,IndexPageBanner,UpdatePageBanner,ViewPageBanner,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(235, 2, 184, 'Index,Create,Update,View,AjaxActivate,AjaxDeactivate,CreatePageBanner,IndexPageBanner,UpdatePageBanner,ViewPageBanner,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(236, 1, 185, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(237, 2, 185, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(238, 1, 186, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(239, 2, 186, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(240, 1, 187, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(241, 2, 187, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(242, 1, 188, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(243, 2, 188, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(244, 1, 189, 'View,Create,Delete,Index,Update,DeleteAll,DeleteImage,SaveFeatured,LoadFullImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(245, 2, 189, 'View,Create,Delete,Index,Update,DeleteAll,DeleteImage,SaveFeatured,LoadFullImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(246, 1, 190, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(247, 2, 190, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(248, 1, 191, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(249, 2, 191, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(250, 1, 192, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(251, 2, 192, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(252, 1, 193, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(253, 2, 193, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(254, 1, 194, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(255, 2, 194, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(256, 1, 195, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(257, 2, 195, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(258, 1, 196, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(259, 2, 196, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(260, 1, 197, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(261, 2, 197, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(262, 1, 198, 'Create,DeleteColor,Index,Image,LoadFullImage,Delete,SaveFeatured,Update,View,AjaxSetDefault,AddColor,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(263, 2, 198, 'Create,DeleteColor,Index,Image,LoadFullImage,Delete,SaveFeatured,Update,View,AjaxSetDefault,AddColor,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(264, 1, 199, 'Create,AddStationery,AddPrint,Checkout,ShippingFee,RemoveFee,GetOption,AddRecord,GetStationeryProduct,GetFeature,Confirm,Delete,DeleteOrderDetail,Index,Update,View,DeleteAll,GetUser,GetProduct,ProductInfo,AddCart,DownloadInvoice,UpdateStatus,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(265, 2, 199, 'Create,AddStationery,AddPrint,Checkout,ShippingFee,RemoveFee,GetOption,AddRecord,GetStationeryProduct,GetFeature,Confirm,Delete,DeleteOrderDetail,Index,Update,View,DeleteAll,GetUser,GetProduct,ProductInfo,AddCart,DownloadInvoice,UpdateStatus,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(266, 1, 200, 'BestPurchasedReport,ViewBestPurchasedReport,LowStockReport,ViewLowStock,ReportSale,View,Export,Delete,DeleteAll,ManualSale,ExportManualSale,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(267, 2, 200, 'BestPurchasedReport,ViewBestPurchasedReport,LowStockReport,ViewLowStock,ReportSale,View,Export,Delete,DeleteAll,ManualSale,ExportManualSale,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(268, 1, 201, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(269, 2, 201, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(270, 1, 202, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(271, 2, 202, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(272, 1, 203, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(273, 2, 203, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(274, 1, 204, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(275, 2, 204, 'Create,Delete,Index,Update,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(276, 1, 205, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(277, 2, 205, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(278, 1, 206, 'Create,Delete,Index,Update,AddMaterial,RemoveMaterial,AddSizePaper,RemoveSizePaper,Price,GenListMaterial,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(279, 2, 206, 'Create,Delete,Index,Update,AddMaterial,RemoveMaterial,AddSizePaper,RemoveSizePaper,Price,GenListMaterial,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(280, 1, 207, 'Create,Delete,Index,Update,View,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(281, 2, 207, 'Create,Delete,Index,Update,View,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(282, 1, 208, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(283, 2, 208, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(284, 1, 209, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(285, 2, 209, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(286, 1, 210, 'Create,Update,Delete,Index,GenListSizePaper', 'allow'),
(287, 2, 210, 'Create,Update,Delete,Index,GenListSizePaper', 'allow'),
(288, 1, 211, 'Create,Update,Delete,Index,GenListMaterial', 'allow'),
(289, 2, 211, 'Create,Update,Delete,Index,GenListMaterial', 'allow'),
(290, 1, 212, 'Create,Delete,Index,Update,View,CreateInCate,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(291, 2, 212, 'Create,Delete,Index,Update,View,CreateInCate,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(292, 1, 213, 'Create,Delete,Index,Update,View,CreateInCate,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(293, 2, 213, 'Create,Delete,Index,Update,View,CreateInCate,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(294, 1, 214, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(295, 2, 214, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(296, 1, 215, 'Create,Index,Update,Delete,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(297, 2, 215, 'Create,Index,Update,Delete,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(298, 1, 216, 'Create,Index,Update,Delete,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(299, 2, 216, 'Create,Index,Update,Delete,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(300, 1, 217, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(301, 2, 217, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(302, 1, 218, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(303, 2, 218, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(304, 1, 219, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(305, 2, 219, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(306, 1, 220, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(307, 2, 220, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(308, 1, 221, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(309, 2, 221, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(310, 1, 222, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(311, 2, 222, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(312, 1, 223, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(313, 2, 223, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(314, 1, 224, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(315, 2, 224, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(316, 1, 225, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(317, 2, 225, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(318, 1, 226, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(319, 2, 226, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(320, 1, 227, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(321, 2, 227, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(322, 1, 228, 'Create,Delete,Index,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(323, 2, 228, 'Create,Delete,Index,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(324, 1, 229, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(325, 2, 229, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(326, 1, 230, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(327, 2, 230, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(328, 1, 231, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(329, 2, 231, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(330, 1, 232, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(331, 2, 232, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(332, 1, 233, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(333, 2, 233, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(334, 1, 234, 'Delete,Index,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(335, 2, 234, 'Delete,Index,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(336, 1, 235, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(337, 2, 235, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(338, 1, 236, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(339, 2, 236, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(340, 1, 237, 'Create,Delete,Index,IndexSub,CreateSub,UpdateSub,ViewSub,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(341, 2, 237, 'Create,Delete,Index,IndexSub,CreateSub,UpdateSub,ViewSub,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(342, 1, 238, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(343, 2, 238, 'Create,Delete,Index,Update,View,DeleteAll,RemoveImage,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveFile', 'allow'),
(344, 1, 239, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(345, 2, 239, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(346, 1, 240, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(347, 2, 240, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(348, 1, 241, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow'),
(349, 2, 241, 'Create,Delete,Index,Update,View,DeleteAll,AjaxActivate,AjaxDeactivate,AjaxShow,AjaxNotShow,AjaxApprove,RemoveImage,RemoveFile', 'allow');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_actions_users`
--

CREATE TABLE IF NOT EXISTS `raovat_actions_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `controller_id` int(11) DEFAULT NULL,
  `actions` varchar(1000) DEFAULT NULL,
  `can_access` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `raovat_ads`
--

CREATE TABLE IF NOT EXISTS `raovat_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place_holder` varchar(30) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expired_date` date NOT NULL,
  `order_display` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `raovat_ads`
--

INSERT INTO `raovat_ads` (`id`, `place_holder`, `image`, `link`, `status`, `created_date`, `expired_date`, `order_display`) VALUES
(1, 'Blog - Right Side', '1406271960.jpg', 'http://google.com', 1, '2014-06-25 03:13:27', '2014-06-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_applications`
--

CREATE TABLE IF NOT EXISTS `raovat_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_name` varchar(255) NOT NULL,
  `application_short_name` varchar(255) NOT NULL,
  `is_delete` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `raovat_applications`
--

INSERT INTO `raovat_applications` (`id`, `application_name`, `application_short_name`, `is_delete`) VALUES
(1, 'Back-end', 'BE', 0),
(2, 'Front-end', 'FE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_areas`
--

CREATE TABLE IF NOT EXISTS `raovat_areas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `raovat_areas`
--

INSERT INTO `raovat_areas` (`id`, `name`, `status`, `created_date`) VALUES
(1, 'West', 1, '2014-09-09 03:42:49'),
(2, 'East', 1, '2014-09-09 03:43:00'),
(3, 'South', 1, '2014-09-23 03:31:55'),
(4, 'North', 1, '2014-09-23 03:32:15'),
(5, 'Central', 1, '2014-09-23 03:37:01'),
(6, 'North East', 1, '2014-09-24 02:43:47'),
(7, 'North West', 1, '2014-09-24 02:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_area_code`
--

CREATE TABLE IF NOT EXISTS `raovat_area_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(100) NOT NULL,
  `area_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=230 ;

--
-- Dumping data for table `raovat_area_code`
--

INSERT INTO `raovat_area_code` (`id`, `area_name`, `area_code`) VALUES
(229, 'Singapore', '65');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_banners`
--

CREATE TABLE IF NOT EXISTS `raovat_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) NOT NULL,
  `banner_title` text NOT NULL,
  `banner_description` tinytext NOT NULL,
  `thumb_image` varchar(255) NOT NULL,
  `large_image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `place_holder_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `order_display` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `raovat_banners`
--

INSERT INTO `raovat_banners` (`id`, `content`, `name`, `banner_title`, `banner_description`, `thumb_image`, `large_image`, `link`, `place_holder_id`, `status`, `order_display`, `created_date`, `image`, `text1`, `text2`, `text3`) VALUES
(19, '<span><p>We are not fancy</p><h3>BUT WE ARE 111 <span>FANTASTIC 111!</span></h3></span>', '', '', '', '', '', NULL, 0, 1, 1, '2014-12-09 03:43:28', '1418093008_19_banner1.jpg', '', '', ''),
(20, '<span><p>We are not fancy</p><h3>BUT WE ARE <span>FANTASTIC 2222!</span></h3></span>', '', '', '', '', '', NULL, 0, 1, 2, '2014-12-09 03:44:41', '1418093081_20_banner1.jpg', '', '', ''),
(21, '<p><span>We are not fancy</span></p>\r\n\r\n<h3><span>BUT WE ARE <span>FANTASTIC 333 !</span></span></h3>\r\n', '', '', '', '', '', NULL, 0, 1, 1, '2014-12-09 03:45:00', '1418093100_21_banner1.jpg', '', '', ''),
(22, '<p>faebeawbfaweb</p>\r\n\r\n<p>faewfbwefbwaefbwe</p>\r\n', '', '', '', '', '', NULL, 0, 1, 1, '2014-12-15 07:20:18', '1418628121_22_Beach-ocean-waves-natural-image.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_categories`
--

CREATE TABLE IF NOT EXISTS `raovat_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `title_tag` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `raovat_categories`
--

INSERT INTO `raovat_categories` (`id`, `category_name`, `slug`, `display_order`, `status`, `parent_id`, `type`, `level`, `title_tag`, `meta_keyword`, `meta_description`) VALUES
(4, 'Test 2', 'test-2', 2, 1, 0, 'news', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_cms`
--

CREATE TABLE IF NOT EXISTS `raovat_cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `banner` varchar(128) DEFAULT NULL,
  `cms_content` longtext,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `display_order` int(11) DEFAULT NULL,
  `show_in_menu` tinyint(4) DEFAULT '0',
  `place_holder_id` varchar(50) DEFAULT NULL,
  `creator_id` int(250) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `short_content` tinytext,
  `link` varchar(255) DEFAULT NULL,
  `meta_keywords` tinytext,
  `meta_desc` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `raovat_cms`
--

INSERT INTO `raovat_cms` (`id`, `title`, `slug`, `banner`, `cms_content`, `created_date`, `display_order`, `show_in_menu`, `place_holder_id`, `creator_id`, `status`, `short_content`, `link`, `meta_keywords`, `meta_desc`) VALUES
(10, 'Page 1', 'page-1', NULL, '<p>\r\n	Page 1</p>\r\n', '2014-04-18 03:55:14', 3, 1, '', 1, 1, 'no', NULL, 'page1', 'page1'),
(11, 'Page 2', 'page-2', NULL, '<p>\r\n	Page 2 content</p>\r\n', '2014-04-18 03:55:14', NULL, 0, NULL, NULL, 1, NULL, NULL, 'page2', 'page3'),
(14, '-----External Page-----', 'external-page', NULL, '', '2014-04-25 04:24:45', NULL, 0, NULL, NULL, 1, NULL, NULL, '', ''),
(15, 'admin1', 'admin1', NULL, '', '2014-04-26 03:13:34', NULL, 0, NULL, NULL, 0, NULL, NULL, '', ''),
(22, 'Coming soon', 'approve-successfully', NULL, '<p>\r\n	{company_name}Coming soon.</p>\r\n', '2014-04-18 03:55:14', 1, 1, '', 1, 1, 'no', NULL, 'nothing', 'nothing'),
(23, 'Thank you for registering', 'thank-you-for-registering', NULL, '<h1>\r\n	Thank you!</h1>\r\n', '2014-06-14 08:22:16', NULL, 0, NULL, NULL, 1, NULL, NULL, '', ''),
(24, 'Term Of Use', 'term-of-use', NULL, '<p>\r\n	Term of Use &#39;s content.</p>\r\n', '2014-06-14 08:54:53', NULL, 0, NULL, NULL, 1, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_controllers`
--

CREATE TABLE IF NOT EXISTS `raovat_controllers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller_name` varchar(63) DEFAULT NULL,
  `module_name` varchar(63) DEFAULT NULL,
  `actions` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `controller_name` (`controller_name`),
  KEY `controller_name_2` (`controller_name`),
  KEY `module_name` (`module_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=242 ;

--
-- Dumping data for table `raovat_controllers`
--

INSERT INTO `raovat_controllers` (`id`, `controller_name`, `module_name`, `actions`) VALUES
(106, 'ActionsRoles', 'admin', 'View, Create, Update, Delete, List, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(107, 'ActionsUsers', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(108, 'Applications', 'admin', 'View, Create, Update, Delete, Index, Admin, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(110, 'Banners', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(114, 'Controllers', 'admin', 'View, Edit, Create, Update, Delete, Index, Group, User, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove, GetControlerList,GetAvailableAction'),
(115, 'Emailtemplates', 'admin', 'View, Create, Update, Delete, Index, Admin, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(117, 'Manageadmin', 'admin', 'View, Create, Update, Delete, Index, Update_my_profile, Change_my_password, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove, DeleteAll'),
(118, 'Managebanner', 'admin', 'View, Help, Update, AddCustomPhoto, ChooseModel, Delete, Index, HandleCropZoom, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(119, 'Users', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(120, 'Backmenus', 'admin', 'View, Create, Getcheckbox, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(121, 'Newsletter', 'admin', 'Create, View, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(122, 'Pages', 'admin', 'View, Create, Imagepaging, Imageurl, Imageupload, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove, DeleteAll, RemoveImage'),
(125, 'Roles', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(127, 'Setting', 'admin', 'Update, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove, SendTestMail'),
(128, 'Site', 'admin', 'ForgotPassword, ResetPassword, ChangePassword, Error, Index, Login, Logout, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(129, 'Subscriber', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(142, 'Subscribergroup', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(155, 'Ads', 'admin', 'View, Create, Update, Delete, Index, Up, Down, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(156, 'AdminAccount', 'admin', 'View, Create, Update, Delete, Index, Update_my_profile, Change_my_password, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(157, 'Seos', 'admin', 'View, Create, Update, Delete, Index, Admin, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(158, 'Frontmenus', 'admin', NULL),
(159, 'Smartblocks', 'admin', NULL),
(160, 'Newscategories', 'admin', NULL),
(161, 'News', 'admin', NULL),
(168, 'Countries', 'admin', NULL),
(169, 'PageBanners', 'admin', NULL),
(174, 'Application', 'admin', NULL),
(180, 'Areas', 'admin', NULL),
(181, 'Locations', 'admin', NULL),
(184, 'HomeBlock', 'admin', NULL),
(188, 'Categories', 'admin', NULL),
(190, 'Brands', 'admin', NULL),
(199, 'Orders', 'admin', NULL),
(200, 'Report', 'admin', NULL),
(239, 'Job', 'admin', NULL),
(240, 'State', 'admin', NULL),
(241, 'TinRaoVat', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_email_templates`
--

CREATE TABLE IF NOT EXISTS `raovat_email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_subject` longtext,
  `email_body` text,
  `parameter_description` text,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `raovat_email_templates`
--

INSERT INTO `raovat_email_templates` (`id`, `email_subject`, `email_body`, `parameter_description`, `type`) VALUES
(1, 'Registered sucessfully!', '<p><strong><em>Dear &nbsp;{FULL_NAME}, </em></strong></p>\r\n\r\n<p>Thank you for registering with Speed Prinzt. Please find below your information:</p>\r\n\r\n<p><strong>Your Information</strong></p>\r\n\r\n<p>Full name: {FULL_NAME}</p>\r\n\r\n<p>Email: {EMAIL}</p>\r\n\r\n<p>Please begin by login with this link: {LINK_LOGIN}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'Send to customer\r\n{EMAIL}: email\r\n{FULL_NAME}\r\n{LINK_LOGIN}: link login\r\n\r\n', NULL),
(2, 'A new member has been added.', '<p><strong><em>Dear &nbsp;Administrator,</em></strong></p>\r\n\r\n<p>A new member has registered&nbsp;with Speed Printz website&nbsp;with below information.</p>\r\n\r\n<p><strong>Information</strong></p>\r\n\r\n<p>Full name: {FULL_NAME}</p>\r\n\r\n<p>Email: {EMAIL}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Send a notification to Admin for new member\r\n{EMAIL}: email\r\n{FULL_NAME} \r\n', NULL),
(3, 'Reset your password', '<p><strong><em>Dear &nbsp;{FULL_NAME},</em></strong></p>\r\n\r\n<p>We have received a request to reset the password for your account. If you did not request to reset your password, please ignore this email.</p>\r\n\r\n<p>{RESET_LINK}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'to customer\r\nsend email to User for forgetting password\r\n{FULL_NAME}: name of user.\r\n{RESET_LINK}', NULL),
(4, 'Contact Us from: {NAME} - send to Admin   ', '<p><strong><em>Dear Administrator</em>,</strong><br />\r\n<br />\r\n<strong>{EMAIL}</strong>&nbsp;has contacted you from Design Of Asia&nbsp;website:<br />\r\nThe contact details are:</p>\r\n\r\n<p>Name: {NAME}&nbsp;</p>\r\n\r\n<p>Email: {EMAIL}&nbsp;</p>\r\n\r\n<p>Message: {MESSAGE}</p>\r\n\r\n<p>Phone: {PHONE}</p>\r\n\r\n<p>Company: {COMPANY}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>Design Of Asia<br />\r\nCopyright &copy; 2014 <span style="line-height: 20.7999992370605px;">Design Of Asia</span> Pte Ltd. All rights reserved.</p>\r\n', 'Email to Admin\r\n{NAME}    \r\n{EMAIL}   \r\n{MESSAGE}\r\n{PHONE}\r\n{COMPANY}\r\n', NULL),
(5, 'Contact Us - Send mail to User', '<p><strong><em>Dear {NAME}</em>,</strong><br />\r\n<br />\r\nThe contact details are:</p>\r\n\r\n<p>Name: {NAME}&nbsp;</p>\r\n\r\n<p>Email: {EMAIL}&nbsp;</p>\r\n\r\n<p>Message: {MESSAGE}</p>\r\n\r\n<p>Phone: {PHONE}</p>\r\n\r\n<p>Company: {COMPANY}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>Design Of Asia<br />\r\nCopyright &copy; 2014 <span style="line-height: 20.7999992370605px;">Design Of Asia</span> Pte Ltd. All rights reserved.</p>\r\n', 'name: {NAME}\r\nemail: {EMAIL}\r\nmessage: {MESSAGE}\r\n{COMPANY}\r\n{PHONE}\r\n', NULL),
(6, 'User change password', '<p><strong><em>Dear &nbsp;{FULL_NAME},</em></strong></p>\r\n\r\n<p>You have changed your password for&nbsp;your account on Speed Printz.</p>\r\n\r\n<p>Your new password is:&nbsp; {PASSWORD}</p>\r\n\r\n<p>Please click this link:&nbsp;&nbsp;{LINK_LOGIN}&nbsp;to login.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'to customer\r\nChange Password\r\n\r\n{FULL_NAME}: name of user.\r\n{PASSWORD}: new password\r\n{LINK_LOGIN}: link login', NULL),
(7, 'Reset Password', '<p>Dear {NAME},</p>\r\n\r\n<p><br />\r\nA request&nbsp;to&nbsp;reset the password has been sent for the following account in <a href="http://verzview.com/verzspeedprintz/demo">Speed Printz</a>&nbsp;website:<br />\r\nEmail: {EMAIL}<br />\r\nUsername: {USERNAME}<br />\r\nIf this was a mistake, please&nbsp;ignore this email.<br />\r\nTo reset your password, visit the following address: {LINK}<br />\r\n&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'to admin\r\n{NAME}: name of user.\r\n{EMAIL}: Email of user\r\n{LINK}: link reset\r\n{USERNAME}', NULL),
(8, 'Reset Password  Admin Account', '<p>Dear {NAME},</p>\r\n\r\n<p>You have requested a new password for <a href="http://verzview.com/verzspeedprintz/demo">Speed Printz</a>&nbsp;website.</p>\r\n\r\n<p>Your new password is:&nbsp; {PASSWORD}</p>\r\n\r\n<p>Please click this link:&nbsp;&nbsp;{LINK_LOGIN}&nbsp;to login.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'To customer\r\n{NAME}: name of user.\r\n{PASSWORD}: new password\r\n{LINK_LOGIN}: link login', NULL),
(9, 'Password changed successfully [send mail to admin]', '<p>Dear {NAME},</p>\r\n\r\n<p>You have&nbsp;changed your&nbsp;password successfully.</p>\r\n\r\n<p>Your new password is:&nbsp; {PASSWORD}</p>\r\n\r\n<p>Please click this link:&nbsp;&nbsp;{LINK_LOGIN}&nbsp;to login.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'to admin\r\n{NAME}: name of user.\r\n{PASSWORD}: new password\r\n{LINK_LOGIN}: link login', NULL),
(18, 'Payment Successfully', '<table border="0" style="width: 100%;">\r\n	<tbody>\r\n		<tr>\r\n			<td style="vertical-align: top; width: 50%; width: 300px;"><img alt="" src="http://verzview.com/upload/ckimage/images/speedprint/logo.png" /></td>\r\n			<td align="right" style="vertical-align: top; width: 350px;">\r\n			<p style="text-align: right;"><span style="font-size:20px;"><strong>INVOICE</strong></span></p>\r\n\r\n			<p style="text-align: right;"><strong>Date</strong> {DATE}</p>\r\n\r\n			<p style="text-align: right;"><strong>Invoice #</strong> {INVOICE_NO}</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2"><strong>Regn #:</strong> {REGN_NUMBER}</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2"><strong>Bill To</strong>: {CUSTOMER_NAME}</td>\r\n		</tr>\r\n<tr>\r\n			<td colspan="2"><strong>Address</strong>: {BILLING_ADDRESS}</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2">\r\n			<p>Comments or special instructions: Template content will be amended by client</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2">\r\n			<p>{ITEMS}</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2">&nbsp;\r\n			<p>Cheque should be crossed and made payable to &quot;SPEED PRINTZ PTE LTD&quot;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2">\r\n			<div style="width: 200px; margin-left:500px; border-top: 1px solid #000; text-align: center;">Speed Printz Pte Ltd</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="text-align: right;">&nbsp;<br />\r\n			<br />\r\n			<br />\r\n			<br />\r\n			<br />\r\n			<br />\r\n			<br />\r\n			&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan="2" style="border-bottom: 1px solid #000;">\r\n			<p style="text-align: center;">Registered Address: 1 Queensway #03-01K Queensway Shopping Ctr/Twr Singapore 149053</p>\r\n\r\n			<p style="text-align: center;">Tel: 96496310 (Edwin Teo) Website: www.speedprintz.com.sg &nbsp;&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '{DATE}\r\n{INVOICE_NO}\r\n{ITEMS}\r\n{BILLING_ADDRESS}\r\n{REGN_NUMBER}', NULL),
(26, 'An order has been made', '<p><em><strong>Dear Adminstrator,</strong></em></p>\r\n\r\n<p>An order has been made. The order number is {ORDER_NO}. Please find below the order information:</p>\r\n\r\n<p><strong>Bill To:</strong> {CUSTOMER_NAME}, {BILLING_ADDRESS}</p>\r\n\r\n<p>{ITEMS}</p>\r\n\r\n<p>Please go to {LINK}&nbsp;to work with this order.</p>\r\n\r\n<p>Regards,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'To admin\r\n{ORDER_NO}: Order no_id\r\n{ITEMS}: table of items\r\n{LINK}:Order detail link\r\n{CUSTOMER_NAME}, \r\n{BILLING_ADDRESS}', NULL),
(27, 'Order status update by admin', '<p style="text-align:right"><img alt="" src="http://verzview.com/upload/ckimage/images/speedprint/logo.png" style="float: left; height: 135px; width: 334px;" /></p>\r\n\r\n<p style="text-align:right">&nbsp;</p>\r\n\r\n<p style="text-align:right">&nbsp;</p>\r\n\r\n<p style="text-align:right">&nbsp;</p>\r\n\r\n<p style="text-align:right">&nbsp;</p>\r\n\r\n<p style="text-align:right">&nbsp;</p>\r\n\r\n<p><strong>Dear {NAME}</strong><strong>,</strong></p>\r\n\r\n<p>Your order&#39;s&nbsp;status has been updated to&nbsp;{STATUS} by administrator.</p>\r\n\r\n<p>Please find below the&nbsp;details&nbsp;of your order:</p>\r\n\r\n<p>{ITEMS}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'To customer\r\n{NAME}: Customer name\r\n{ITEMS}: table of items\r\n{STATUS}: Order status change', NULL),
(28, 'Password Updated', '<p><strong><em>Dear &nbsp;{NAME},</em></strong></p>\r\n\r\n<p>The administrator has updated&nbsp;your password. Here is&nbsp;your new password:</p>\r\n\r\n<p>{PASSWORD}</p>\r\n\r\n<p>If you did not request for a password update to administrator, please contact us immediately.</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'To customer\r\n{NAME}\r\n{PASSWORD}', NULL),
(29, 'Your account details has been updated by Admin', '<p>Dear {FULL_NAME},</p>\r\n\r\n<p>Your account has been updated.</p>\r\n\r\n<p><strong>Account information:</strong></p>\r\n\r\n<p>FULL NAME:&nbsp;{FULL_NAME}</p>\r\n\r\n<p>EMAIL:&nbsp;{EMAIL}</p>\r\n\r\n<p><strong>Contact information:</strong></p>\r\n\r\n<p>CONTACT FIRST NAME:&nbsp;{CONTACT_FIRST_NAME}</p>\r\n\r\n<p>CONTACT LAST NAME: {CONTACT_LAST_NAME}</p>\r\n\r\n<p>PHONE: {PHONE}</p>\r\n\r\n<p>COMPANY: {COMPANY}</p>\r\n\r\n<p>ADDRESS1: {ADDRESS1}</p>\r\n\r\n<p><strong>Address:</strong></p>\r\n\r\n<p>ADDRESS2: {ADDRESS2}</p>\r\n\r\n<p>POSTAL CODE: {POSTAL_CODE}</p>\r\n\r\n<p>COUNTRY: {COUNTRY}</p>\r\n\r\n<p>STATUS:&nbsp;{STATUS}</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Yours Sincerely,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'To customer\r\n{FULL_NAME}\r\n{EMAIL}\r\n{CONTACT_FIRST_NAME}\r\n{CONTACT_LAST_NAME}\r\n{PHONE}\r\n{COMPANY}\r\n{ADDRESS1}\r\n{ADDRESS2}\r\n{POSTAL_CODE}\r\n{COUNTRY}\r\n{STATUS}', NULL),
(30, 'Request for quote [send to admin]', '<p>Dear Admin,</p>\r\n\r\n<p>We have received&nbsp;one request from {FULL_NAME}.</p>\r\n\r\n<p>Details of Request:</p>\r\n\r\n<p>RFQ Code: {RFQ_CODE}</p>\r\n\r\n<p><span style="line-height: 20.7999992370605px;">Name: {FULL_NAME}</span><br />\r\nEmail: {EMAIL}<br />\r\nPhone: {PHONE}<br />\r\nType of solution: {TYPE_OF_SOLUTION}<br />\r\nCategory: {CATEGORY}<br />\r\nPrint Requirement: {PRINT_REQUIREMENT}<br />\r\nPreffered Collection Date:&nbsp;{COLLECT_DATE}<br />\r\nAttachment: {ATTACHMENT}</p>\r\n\r\n<p>Regards,</p>\r\n\r\n<p>SPEED PRINTZ PTE. LTD<br />\r\nCopyright &copy; 2014 Speed Printz Pte Ltd. All rights reserved.</p>\r\n', 'To admin\n{RFQ_CODE}\n{FULL_NAME}: title+first+last\n{EMAIL}\n{PHONE}\n{TYPE_OF_SOLUTION}\n{CATEGORY}\n{PRINT_REQUIREMENT}\n{COLLECT_DATE}\n{ATTACHMENT}', NULL),
(31, 'Enquiry to designer', '<p>To {INTERIOR_NAME}<br />\r\n{ENQUIRY_CODE} : CODE&nbsp;<br />\r\n{ENQUIRY_DATE} &nbsp;: DATE<br />\r\n{ENQUIRY_NAME} : Enquirer Name&nbsp;<br />\r\n{ENQUIRY_EMAIL} : Enquirer Email<br />\r\n{ENQUIRY_PHONE} : Enquirer Phone<br />\r\n{ENQUIRY_MESSAGE} : Message<br />\r\n{PROPERTY_TYPE} : Property Type<br />\r\n{PROPERTY_PRICE} : Property Price<br />\r\n{PRICE_PSF} : Price (psf)<br />\r\n{FLOOR_AREA} :Floor Area<br />\r\n{CONDITIONS} : Conditions<br />\r\n{DEVELOPER} : Developer<br />\r\n{TENURES} :Tenures<br />\r\n{LEAVE_TERM} : Lease Terms<br />\r\n{ENQUIRY_MESSAGE} : Message</p>\r\n', 'To designer\r\n{INTERIOR_NAME} : Designer Name\r\n{ENQUIRY_CODE} : CODE \r\n{ENQUIRY_DATE}  : DATE\r\n{ENQUIRY_NAME} : Enquirer Name \r\n{ENQUIRY_EMAIL} : Enquirer Email\r\n{ENQUIRY_PHONE} : Enquirer Phone\r\n{ENQUIRY_MESSAGE} : Message\r\n{PROPERTY_TYPE} : Property Type\r\n{PROPERTY_PRICE} : Property Price\r\n{PRICE_PSF} : Price (psf)\r\n{FLOOR_AREA} :Floor Area\r\n{CONDITIONS} : Conditions\r\n{DEVELOPER} : Developer\r\n{TENURES} :Tenures\r\n{LEAVE_TERM} : Lease Terms', NULL),
(32, 'Enquiry to admin', '<p>To Admin</p>\r\n\r\n<p>{ENQUIRY_CODE} : CODE&nbsp;<br />\r\n{ENQUIRY_DATE} &nbsp;: DATE<br />\r\n{ENQUIRY_NAME} : Enquirer Name&nbsp;<br />\r\n{ENQUIRY_EMAIL} : Enquirer Email<br />\r\n{ENQUIRY_PHONE} : Enquirer Phone<br />\r\n{ENQUIRY_MESSAGE} : Message<br />\r\n{PROPERTY_TYPE} : Property Type<br />\r\n{PROPERTY_PRICE} : Property Price<br />\r\n{PRICE_PSF} : Price (psf)<br />\r\n{FLOOR_AREA} :Floor Area<br />\r\n{CONDITIONS} : Conditions<br />\r\n{DEVELOPER} : Developer<br />\r\n{TENURES} :Tenures<br />\r\n{LEAVE_TERM} : Lease Terms</p>\r\n', 'To Admin\r\n\r\n{ENQUIRY_CODE} : CODE \r\n{ENQUIRY_DATE}  : DATE\r\n{ENQUIRY_NAME} : Enquirer Name \r\n{ENQUIRY_EMAIL} : Enquirer Email\r\n{ENQUIRY_PHONE} : Enquirer Phone\r\n{ENQUIRY_MESSAGE} : Message\r\n{PROPERTY_TYPE} : Property Type\r\n{PROPERTY_PRICE} : Property Price\r\n{PRICE_PSF} : Price (psf)\r\n{FLOOR_AREA} :Floor Area\r\n{CONDITIONS} : Conditions\r\n{DEVELOPER} : Developer\r\n{TENURES} :Tenures\r\n{LEAVE_TERM} : Lease Terms', NULL),
(33, 'Snatch Now', '<p>Dear administrator,</p>\r\n\r\n<p>This user {EMAIL_ADDRESS} has requested this {DEAL_NAME} deal, below is deal&#39;s detail:</p>\r\n\r\n<p>{DEAL_LINK}</p>\r\n\r\n<p>Sincerely</p>\r\n\r\n<p><br />\r\nThe Design of Asia Team<br />\r\nwww.designofasia.com.sg</p>\r\n\r\n<p>COPYRIGHT &copy;2014 DESIGN OF ASIA PTE LTD. ALL RIGHTS RESERVED.</p>\r\n', '{EMAIL_ADDRESS}\r\n{DEAL_NAME} \r\n{DEAL_LINK}', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_fe_menus`
--

CREATE TABLE IF NOT EXISTS `raovat_fe_menus` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(2) DEFAULT NULL,
  `required_login` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'page' COMMENT 'page, custom URL',
  `parent_id` bigint(11) DEFAULT '0',
  `place_holder_id` bigint(11) DEFAULT NULL,
  `page_id` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `raovat_fe_menus`
--

INSERT INTO `raovat_fe_menus` (`id`, `name`, `link`, `order`, `required_login`, `status`, `type`, `parent_id`, `place_holder_id`, `page_id`) VALUES
(1, 'Event Details', 'http://localhost/seapex/event/social-events', 6, 0, 1, 'url', 0, 1, 9),
(6, 'Registration', 'http://google.com', 3, 0, 1, 'url', 0, NULL, 9),
(7, 'Accommodation', 'http://zing.vn', 4, 0, 1, 'url', 0, NULL, 9),
(8, 'test', 'coming-soon', 1, 0, 1, 'page', 0, NULL, 9),
(9, 'cms page test', 'page-2', 5, 0, 1, 'page', 0, NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_group_subscriber`
--

CREATE TABLE IF NOT EXISTS `raovat_group_subscriber` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subscriber_id` int(10) unsigned DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `raovat_group_subscriber`
--

INSERT INTO `raovat_group_subscriber` (`id`, `subscriber_id`, `group_id`) VALUES
(38, 12, 1),
(44, 11, 1),
(36, 10, 2),
(42, 15, 2),
(40, 16, 2),
(41, 17, 2),
(43, 15, 4),
(45, 11, 4),
(46, 20, 2),
(47, 21, 2),
(48, 22, 2),
(49, 23, 2),
(50, 24, 2),
(51, 25, 2),
(52, 26, 2),
(53, 27, 2),
(54, 28, 2),
(55, 29, 2),
(56, 30, 2),
(57, 31, 2);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_home_block`
--

CREATE TABLE IF NOT EXISTS `raovat_home_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `order_display` int(11) NOT NULL,
  `page` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `raovat_home_block`
--

INSERT INTO `raovat_home_block` (`id`, `image`, `name`, `link`, `title`, `content`, `type`, `price`, `status`, `order_display`, `page`) VALUES
(15, '1418094393_15_img2.jpg', '', 'https://www.facebook.com', '', '', 'adsbanner', '', 1, 10, ''),
(16, '1418094670_16_img3.jpg', '', 'https://www.facebook.com', '', '', 'adsbanner', '', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_ip_logins`
--

CREATE TABLE IF NOT EXISTS `raovat_ip_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `ip_address` varchar(32) DEFAULT NULL,
  `time_login` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `raovat_ip_logins`
--

INSERT INTO `raovat_ip_logins` (`id`, `username`, `ip_address`, `time_login`) VALUES
(2, 'admin', '127.0.0.1', 1406086626);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_job`
--

CREATE TABLE IF NOT EXISTS `raovat_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `order_display` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `raovat_job`
--

INSERT INTO `raovat_job` (`id`, `name`, `slug`, `status`, `order_display`, `created_date`, `updated_date`) VALUES
(1, 'Cần Thợ', 'can-tho', 1, 1, '2015-03-23 00:00:00', '2015-03-23 12:31:00'),
(2, 'Sang Tiệm', 'sang-tiem', 1, 2, '2015-03-23 00:00:00', '2015-03-23 12:31:10'),
(3, 'Nhận Giữ Trẻ', 'nhan-giu-tre', 1, 1, '2015-03-23 12:31:31', '2015-03-23 12:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_links`
--

CREATE TABLE IF NOT EXISTS `raovat_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `target` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `visible` varchar(45) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `rel` varchar(45) DEFAULT NULL,
  `notes` mediumtext,
  `rss` varchar(45) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `raovat_logger`
--

CREATE TABLE IF NOT EXISTS `raovat_logger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(128) NOT NULL,
  `category` varchar(128) NOT NULL,
  `logtime` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `raovat_menu`
--

CREATE TABLE IF NOT EXISTS `raovat_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `maxdepth` smallint(6) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `raovat_menu`
--

INSERT INTO `raovat_menu` (`id`, `title`, `maxdepth`, `created`, `modified`) VALUES
(1, 'Footer Column 1', 0, '2014-04-25 03:10:54', NULL),
(2, 'Footer Column 2', 0, '2014-04-25 03:10:54', NULL),
(7, 'Main', 0, '2014-11-20 02:29:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_menuitem`
--

CREATE TABLE IF NOT EXISTS `raovat_menuitem` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `page_id` bigint(11) DEFAULT NULL,
  `target` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '_self',
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  `menu_id` bigint(11) NOT NULL,
  `parent_id` bigint(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=651 ;

--
-- Dumping data for table `raovat_menuitem`
--

INSERT INTO `raovat_menuitem` (`id`, `type`, `name`, `link`, `order`, `status`, `page_id`, `target`, `icon`, `created`, `modified`, `menu_id`, `parent_id`) VALUES
(612, 0, 'Interior Designers', 'http://verzview.com/verzdesignasia/demo/interior-designers', 1, 1, 0, '_self', NULL, '2014-12-11 09:11:46', NULL, 7, 0),
(613, 0, 'Home Products', 'http://verzview.com/verzdesignasia/demo/home-product', 1, 1, 0, '_self', NULL, '2014-12-11 09:11:46', NULL, 7, 0),
(614, 0, 'Services', 'http://verzview.com/verzdesignasia/demo/services', 1, 1, 0, '_self', NULL, '2014-12-11 09:11:46', NULL, 7, 0),
(615, 0, 'Property Listing', 'http://verzview.com/verzdesignasia/demo/property-listing', 1, 1, 0, '_self', NULL, '2014-12-11 09:11:46', NULL, 7, 0),
(616, 0, 'Lifestyle ', 'http://verzview.com/verzdesignasia/demo/lifestyle', 1, 1, 0, '_self', NULL, '2014-12-11 09:11:46', NULL, 7, 0),
(617, 0, 'Special Deals', 'http://verzview.com/verzdesignasia/demo/special-deals', 1, 1, 0, '_self', NULL, '2014-12-11 09:11:46', NULL, 7, 0),
(618, 0, 'News & Events', 'http://verzview.com/verzdesignasia/demo/news-event', 1, 1, 0, '_self', NULL, '2014-12-11 09:11:46', NULL, 7, 0),
(635, 0, 'Home', 'http://verzview.com/verzdesignasia/demo', 1, 1, 0, '_self', NULL, '2014-12-15 07:37:19', NULL, 1, 0),
(636, 0, 'About Us', 'http://verzview.com/verzdesignasia/demo/about-us', 1, 1, 0, '_self', NULL, '2014-12-15 07:37:19', NULL, 1, 0),
(637, 0, 'Interior Designers', 'http://verzview.com/verzdesignasia/demo/interior-designers', 1, 1, 0, '_self', NULL, '2014-12-15 07:37:20', NULL, 1, 0),
(638, 0, 'Home Products', 'http://verzview.com/verzdesignasia/demo/home-product', 1, 1, 0, '_self', NULL, '2014-12-15 07:37:20', NULL, 1, 0),
(639, 0, 'Services', 'http://verzview.com/verzdesignasia/demo/services', 1, 1, 0, '_self', NULL, '2014-12-15 07:37:20', NULL, 1, 0),
(640, 0, 'Property Listing', 'http://verzview.com/verzdesignasia/demo/property-listing', 1, 1, 0, '_self', NULL, '2014-12-15 07:37:20', NULL, 1, 0),
(646, 0, 'Lifestyle', 'http://verzview.com/verzdesignasia/demo/lifestyle', 1, 1, 0, '_self', NULL, '2014-12-15 07:38:35', NULL, 2, 0),
(647, 0, 'Special Offers', 'http://verzview.com/verzdesignasia/demo/special-deals', 1, 1, 0, '_self', NULL, '2014-12-15 07:38:35', NULL, 2, 0),
(648, 0, 'News & Events', 'http://verzview.com/verzdesignasia/demo/news-event', 1, 1, 0, '_self', NULL, '2014-12-15 07:38:35', NULL, 2, 0),
(649, 0, 'Contact Us', 'http://verzview.com/verzdesignasia/demo/contact-us', 1, 1, 0, '_self', NULL, '2014-12-15 07:38:35', NULL, 2, 0),
(650, 0, 'Terms of Use', 'http://verzview.com/verzdesignasia/demo/term-of-use', 1, 1, 0, '_self', NULL, '2014-12-15 07:38:35', NULL, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_menus`
--

CREATE TABLE IF NOT EXISTS `raovat_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `menu_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_order` int(11) NOT NULL,
  `show_in_menu` tinyint(4) NOT NULL,
  `application_id` int(11) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=156 ;

--
-- Dumping data for table `raovat_menus`
--

INSERT INTO `raovat_menus` (`id`, `menu_name`, `menu_link`, `display_order`, `show_in_menu`, `application_id`, `parent_id`) VALUES
(51, 'System Configuration', 'admin/setting/index', 2, 1, 1, 55),
(53, 'CMS', '#', 9, 1, 1, 0),
(55, 'System', '#', 15, 1, 1, 0),
(56, 'Admin Accounts', 'admin/manageadmin', 1, 1, 1, 55),
(60, 'Email Templates', 'admin/emailtemplates', 3, 1, 1, 53),
(62, 'Members', 'admin/users', 1, 0, 1, 0),
(64, 'Home Banners', 'admin/banners', 1, 1, 1, 63),
(65, 'Ads', 'admin/ads', 2, 0, 1, 63),
(66, 'Newsletters', '#', 2, 0, 1, 0),
(67, 'Newsletters', 'admin/newsletter', 1, 0, 1, 66),
(68, 'Subscribers', 'admin/subscriber', 2, 1, 1, 66),
(69, 'Subcriber Groups', 'admin/subscribergroup', 3, 1, 1, 66),
(70, 'SEO', 'admin/seos', 3, 1, 1, 55),
(71, 'Pages', 'admin/pages', 1, 1, 1, 53),
(72, 'Front Menus', 'admin/frontmenus', 1, 1, 1, 53),
(73, 'Smart Blocks', 'admin/smartblocks', 1, 1, 1, 53),
(77, 'Master Fields', '#', 14, 1, 1, 0),
(82, 'Countries', 'admin/countries/index', 9, 1, 1, 77),
(83, 'Page Banners', 'admin/pageBanners', 2, 0, 1, 63),
(84, 'Banner', '', 10, 1, 1, 0),
(102, 'Ads Banner', 'admin/homeBlock/index', 1, 1, 1, 84),
(114, 'Home Banners', 'admin/banners', 10, 0, 1, 84),
(117, 'Stationeries', 'admin/stationeries', 4, 1, 1, 119),
(118, 'Stationery Category', 'admin/stationeryCategories', 1, 1, 1, 119),
(147, 'List State', 'admin/state', 2, 1, 1, 0),
(148, 'Category', '#', 1, 0, 1, 0),
(149, 'List State', 'admin/state', 1, 1, 1, 148),
(151, 'List Job', 'admin/job', 2, 1, 1, 148),
(152, 'List Job', 'admin/job', 3, 1, 1, 0),
(155, 'Tin Rao Vat', 'admin/tinRaoVat', 5, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_modules`
--

CREATE TABLE IF NOT EXISTS `raovat_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(63) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `raovat_newsletter`
--

CREATE TABLE IF NOT EXISTS `raovat_newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `content` text,
  `created_time` datetime NOT NULL,
  `send_time` datetime DEFAULT NULL,
  `remain_subscribers` text,
  `total_subscriber` int(11) NOT NULL DEFAULT '0',
  `total_sent` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `raovat_newsletter`
--

INSERT INTO `raovat_newsletter` (`id`, `subject`, `content`, `created_time`, `send_time`, `remain_subscribers`, `total_subscriber`, `total_sent`) VALUES
(5, 'test newsletter', '<p>test content</p>\r\n', '2014-11-07 17:11:25', '2014-11-30 05:20:00', '', 5, 5),
(6, 'test', '<p>dshgfh</p>\r\n\r\n<p>gfsg</p>\r\n\r\n<p>ghdgf</p>\r\n\r\n<p>hdghgd</p>\r\n\r\n<p>jdfwuywu</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2014-12-02 16:46:45', '2014-12-02 04:00:00', '', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_newsletter_group_subscriber`
--

CREATE TABLE IF NOT EXISTS `raovat_newsletter_group_subscriber` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `newsletter_id` int(11) NOT NULL,
  `subscriber_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `raovat_newsletter_group_subscriber`
--

INSERT INTO `raovat_newsletter_group_subscriber` (`id`, `newsletter_id`, `subscriber_group_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(39, 3, 2),
(40, 3, 1),
(45, 2, 2),
(48, 4, 2),
(56, 5, 2),
(57, 5, 1),
(58, 5, 3),
(61, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_newsletter_tracking`
--

CREATE TABLE IF NOT EXISTS `raovat_newsletter_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_id` int(11) NOT NULL,
  `subscriber_email_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `raovat_place_holders`
--

CREATE TABLE IF NOT EXISTS `raovat_place_holders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `raovat_place_holders`
--

INSERT INTO `raovat_place_holders` (`id`, `position`) VALUES
(1, 'Top'),
(2, 'Left'),
(3, 'Bottom'),
(4, 'Right');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_posts`
--

CREATE TABLE IF NOT EXISTS `raovat_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` tinyint(4) DEFAULT NULL,
  `posted_by` bigint(11) DEFAULT NULL,
  `post_type` varchar(20) DEFAULT 'page',
  `title_tag` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `meta_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `featured_image` varchar(300) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `slug` varchar(400) DEFAULT NULL,
  `retail_price` decimal(16,2) NOT NULL,
  `now_price` decimal(16,2) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `User_idx` (`posted_by`),
  KEY `slug` (`slug`),
  KEY `status` (`status`),
  KEY `title` (`title`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `raovat_posts`
--

INSERT INTO `raovat_posts` (`id`, `title`, `short_content`, `content`, `status`, `posted_by`, `post_type`, `title_tag`, `meta_keywords`, `meta_desc`, `featured_image`, `display_order`, `created_date`, `modified_date`, `slug`, `retail_price`, `now_price`, `parent_id`, `link`) VALUES
(8, 'REGISTER SUCCESS', NULL, '<p>Thank you for being a tutor from TopNotch Tutor, Singapore&#39;s favourite online tuition agency.&nbsp;</p>\r\n\r\n<p>Our&nbsp;coordinators will match a suitable tutor for you within the next 24 hours. We might take a little longer if your requirements&nbsp;are more complex. If your request is urgent, please call us immediately.</p>\r\n\r\n<p>Please quote this ID number if you wish to check on the status of your request.</p>\r\n\r\n<p>Thank you once again for engaging TopNotch Tutor!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Note: Personal Data Protection Act 2012 (PDPA)</strong></p>\r\n\r\n<p>Starting from January 2014, the Do Not Call (DNC) provisions under the Personal Data Protection Act (PDPA) generally prohibits organisations and companies from sending certain marketing messages (in the form of voice calls, text or fax messages) to Singapore telephone numbers, including mobile, fixed-line, residential and business numbers, registered with the DNC Registry.</p>\r\n\r\n<p>Please be assured that TopNotch Tutor will consider the privacy of your personal information a subject of absolute importance. Personal information includes but is not limited to your name, telephone number, handphone number, email address, home address as well as any information you have provided to TopNotch Tutor.</p>\r\n\r\n<p>By providing your personal information such as telephone number, handphone number and email address to us, you therefore <u>give consent</u> to receiving SMSES, phone calls or emails from our coordinators in the tuition-matching process. TopNotch Tutor knows you care how information about you is used and shared, and we appreciate your trust that we will do so carefully and sensibly.</p>\r\n\r\n<p>If you decide to exclude yourself from our engagements and remove your personal information from our database permanently, please send an email to <a href="mailto:info@tutorcity.com.sg">info@topnotchtutor.com.sg</a>.</p>\r\n\r\n<p>Best Regards.</p>\r\n', 1, 2, 'page', '', '', '', NULL, NULL, '2014-07-14 16:52:34', '2014-09-29 12:12:17', 'register-success', '0.00', '0.00', 0, NULL),
(14, 'Contact Us', NULL, '<div class="company_address">\r\n<h3>Our Information :</h3>\r\n\r\n<p><font size="+1.5"><b>AAQsolution, Inc.</b></font></p>\r\n\r\n<p><i>6942 N 74th Ave</i></p>\r\n\r\n<p><i>Glendale, AZ 85303</i></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Phone: <b>(714) 224-8238</b></p>\r\n\r\n<p>Email: <span>aaqsolution@gmail.com</span></p>\r\n\r\n<p>Appointment Monday - Saturday 8 am to 7 pm.</p>\r\n\r\n<p>Follow on: <span><a href="https://www.facebook.com/promotionptaz"><img src="http://localhost/upload/ckimage/images/face_follow.png" /></a></span> <span><a href="https://plus.google.com/109124683524310781773/"><img src="http://localhost/upload/ckimage/images/g%2B_follow.png" /></a></span></p>\r\n</div>\r\n', 1, 3, 'block', NULL, NULL, NULL, NULL, 1, '2014-09-01 10:48:52', '2015-03-23 16:47:02', 'contact-us', '0.00', '0.00', 0, ''),
(22, 'Term Of Use', NULL, '<div class="main clearfix">\r\n<div class="clearfix">\r\n<h2>1. SHIPPING POLICY</h2>\r\n</div>\r\n\r\n<div class="document">\r\n<h3><span style="text-decoration: underline;">1.1 Shipping Process</span></h3>\r\n\r\n<p>In order to ensure that you receive your order, please kindly assist us by ensuring that the mailing address entered in your order form is accurate as we are unable to re-route your order once it has been sent to you.</p>\r\n\r\n<p>Upon confirmation and payment, your order will be processed and your shoes will be ready for shipment within four to six (4-6) weeks after order confirmation. To ensure that you have a peace of mind, we do carry out checks prior to shipping to ensure that the shoes are not damaged and we will also send pictures of the shoes for your verification. As such, we are not responsible for any damage sustained to the shoes after they have been handed over to the shipping agent.</p>\r\n\r\n<p>When your order is shipped, a tracking number will be issued to you so that you can track the delivery of your order. Depending on your mailing address, your order will take up to two (2) weeks to reach you. For more remote addresses, your order may take more than two (2) weeks to arrive at the designated mailing address. To avoid any disappointment, please kindly allow six to eight (6-8) weeks for your order to be processed and delivered.</p>\r\n\r\n<p>You will need to bear any duties or taxes imposed on your order by your country&rsquo;s relevant customs or border authorities. Please kindly note that the prices quoted for all our merchandise are exclusive of any such duties or taxes.</p>\r\n\r\n<h3><span style="text-decoration: underline;">1.2 Shipping Destinations and Fees</span></h3>\r\n\r\n<p>We ship to parts of Asia (Malaysia, Hong Kong, Taiwan, Japan), United States of America, Canada, Australia and parts of Europe (France, Germany, United Kingdom).</p>\r\n\r\n<p>We charge a shipping fee of SGD 65 for each pair of shoes ordered. By way of an illustration, for an order of two pairs of shoes, a shipping fee of SGD 130 will be payable.</p>\r\n\r\n<p>If you need the shoes to be delivered to a destination other than those stated above, please kindly email us at enquiries@edetal.sg for a shipping quotation.</p>\r\n\r\n<h2>2. EXCHANGE POLICY</h2>\r\n\r\n<h3><span style="text-decoration: underline;">2.1 Exchange Process</span></h3>\r\n\r\n<p>In the event you wish to exchange the original shoes ordered for another pair, please kindly email us at enquiries@edetal.sg and provide us with the details of the exchange requested, including the size, colour and design of the requested pair of shoes.</p>\r\n\r\n<p>Within forty-eight (48) hours of an exchange request, we will issue a Returns Authorisation Form which must be sent back to us together with the original receipt of the order and the shoes to be returned. The returned shoes must reach us within twenty-eight (28) days from the date of the Returns Authorisation Form. We reserve the right to reject any exchange request if the returned shoes are not accompanied with the required supporting documents or if the returned shoes are received after the above-mentioned timeframe.</p>\r\n\r\n<h3><span style="text-decoration: underline;">2.2 Conditions of Exchange</span></h3>\r\n\r\n<p>All exchanges are subject to stock availability and only one exchange will be allowed for each pair of shoes ordered.</p>\r\n\r\n<p>If you wish to exchange for a pair of shoes of a higher value, you will need to top up the price difference and the exchange will only be processed after the payment of the price difference.</p>\r\n\r\n<p>If you wish to exchange for a pair of shoes of a lower value, we will not be able to provide a partial refund but a store credit of the value of the price difference will be issued to you to be used in your next purchase.</p>\r\n\r\n<p>For all exchanges, you will need to bear the shipping costs to ship the returned shoes back to us and we will bear the shipping costs to ship the new pair of shoes to you.</p>\r\n\r\n<p>We strongly advise that you obtain proof of postage of the returned shoes as we will not be responsible for any lost package.</p>\r\n\r\n<h2>3. RETURNS</h2>\r\n\r\n<h3><span style="text-decoration: underline;">3.1 Condition of Returned Shoes</span></h3>\r\n\r\n<p>Unless we deem the shoes to be defective, we will only accept shoes which are returned in their unworn condition together with all accompanying <span class="eymv716v33" id="eymv716v33_1" style="font-weight: bold; height: 12px;">accessories</span>, including shoelaces and shoe bags and in its original shoebox. Shoes are deemed to be worn if their soles have been scratched and in this regard, we would recommend that you try out the shoes indoors on a carpeted surface first before taking the shoes out for a walk. Shoes returned in an otherwise condition will not be accepted for an exchange or a refund.</p>\r\n\r\n<h3><span style="text-decoration: underline;">3.2 Defective Shoes</span></h3>\r\n\r\n<p>In the event you are of the view that the shoes received are defective, please kindly email us at enquiries@edetal.sg and provide us with a description and pictures of the apparent defect for our assessment.</p>\r\n\r\n<p>Please kindly note that shoes which are damaged after they have been handed over to the shipping agent or as a result of wear and tear from normal usage will not be regarded as being defective. As a general guide only, shoes with any manufacturing defect showing up within six (6) months from the date of the order will be regarded as being defective.</p>\r\n\r\n<p>If we assess the shoes received by you to be defective, we will, at no costs to you, make arrangements for the defective shoes to be collected and shipped back to us and we will also repair the defective shoes or send a new pair of shoes (in the same size and model) to you, as appropriate. When we receive the defective shoes, we will notify you via email and update you on the repairs or the status of the shipment of the new pair of shoes.</p>\r\n\r\n<h3><span style="text-decoration: underline;">3.3 Refund</span></h3>\r\n\r\n<p>If upon receipt of the defective shoes, we are of the view that the shoes are beyond repair, we will provide a full refund for those shoes through the PayPal account used for the order.</p>\r\n\r\n<h2>4. DETERMINE YOUR SHOE SIZE</h2>\r\n\r\n<p>Our shoe sizes are based on the European sizing system. To assist you in determining your shoe size, please refer to the following link for a sizing guide (Please print in ACTUAL size):</p>\r\n\r\n<p><a href="http://edetal.sg/edetal_sizing_tool.pdf">http://edetal.sg/edetal_sizing_tool.pdf</a></p>\r\n\r\n<p>Please kindly note that the sizing guide will only be able to provide an estimation of a suitable shoe size and is unable to guarantee a perfect fit for the shoes.</p>\r\n\r\n<h2>5. CONTACT US</h2>\r\n\r\n<p>Should you need any clarifications or have any enquiries about making an online purchase, do feel free to drop us an email at enquiries@edetal.sg and we will attend to you as soon as we can.</p>\r\n\r\n<h2>6. PROTECTION OF PERSONAL DATA</h2>\r\n\r\n<p>In order for us to provide the services in connection with your order, you consent to the collection, use, disclosure and retention of your personal information.</p>\r\n</div>\r\n</div>\r\n', 1, 2, 'page', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', NULL, 8, '2014-09-15 16:27:28', '2014-12-09 12:31:33', 'term-of-use', '0.00', '0.00', 0, NULL),
(28, 'Privacy & Security', NULL, '<p>Updating ...</p>\r\n', 1, 2, 'page', '', '', '', NULL, 8, '2014-10-24 07:14:51', '2014-11-19 12:33:53', 'privacy-security', '0.00', '0.00', 0, NULL),
(29, 'About Us', NULL, '<h3 class="ttl-cnt">About us</h3>\r\n\r\n<div class="document"><img alt="" class="img-doc-left" src="img/img8.jpg" />\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Aliquam vehicula velit eu sem imperdiet pellentesque. Phasellus sit amet quam eu diam interdum interdum ut vel nulla. Vestibulum gravida felis id molestie bibendum. In nec velit at enim blandit placerat id vel dui.</p>\r\n\r\n<p>Duis feugiat nisi ipsum, at gravida lorem posuere ultricies. Etiam laoreet eget ligula in consectetur. Quisque a lobortis tortor, a dignissim enim. Praesent lorem arcu, consequat non ligula non, blandit molestie nisi. Curabitur id nunc lacus. Quisque quis vestibulum neque. Ut fermentum dolor non eros porta efficitur. Nam faucibus libero id efficitur fringilla. Fusce vel nunc leo. Aenean rutrum hendrerit lacus, id accumsan turpis efficitur luctus. Praesent ac placerat leo.</p>\r\n\r\n<p>Aliquam bibendum dapibus dignissim. Curabitur vitae aliquet nunc. Nunc in magna diam. Etiam venenatis accumsan mauris, ut eleifend nibh mattis at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras volutpat fringilla purus rhoncus gravida. Integer non diam justo. Quisque eget dui at ex euismod fermentum ac eu est. Integer bibendum eu orci in scelerisque. Nullam lobortis orci in arcu lacinia luctus. Mauris lacinia lacinia lobortis. Mauris ac dictum quam. Nullam faucibus ligula vel nulla posuere, eu sollicitudin sem mollis. Praesent eleifend tellus erat, ac ultrices turpis eleifend quis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer mollis, tellus ut interdum ultricies, arcu arcu condimentum orci, et ultrices nisl risus id erat.</p>\r\n\r\n<h3><em>&quot;Nunc dictum mi sapien, non dignissim tellus tristique ut. Morbi id nunc finibus, lobortis elit id, auctor nisi. Aliquam enim nibh, dictum a orci sed, congue posuere neque. Phasellus blandit&quot;</em></h3>\r\n</div>\r\n', 1, 2, 'page', 'About Us', 'About Us', 'About Us', NULL, 6, '2014-10-29 11:48:34', '2014-12-11 12:17:01', 'about-us', '0.00', '0.00', 0, NULL),
(34, 'Corporate Gifts', NULL, '<p>Updating ...</p>\r\n', 1, 2, 'page', '', '', '', NULL, 8, '2014-11-19 16:22:05', NULL, 'corporate-gifts', '0.00', '0.00', 0, NULL),
(35, 'Promotions', NULL, '<p>Updating ...</p>\r\n', 1, 2, 'page', '', '', '', NULL, 9, '2014-11-19 16:23:25', NULL, 'promotions', '0.00', '0.00', 0, NULL),
(43, 'FAQ', NULL, '<p>content...</p>\r\n', 1, 2, 'page', '', '', '', NULL, 10, '2014-12-02 15:23:49', NULL, 'faq', '0.00', '0.00', 0, NULL),
(44, 'abc', NULL, '<p>fdfsdf</p>\r\n\r\n<p>fdfd</p>\r\n\r\n<p>fdfdfd</p>\r\n', 1, 2, 'page', '', '', '', NULL, 11, '2014-12-08 10:17:06', NULL, 'abc', '0.00', '0.00', 0, NULL),
(47, '52" Samsung LED 3D Smart TV', '<p>The Samsung Smart TV finds the movies and TV shows you like - and more. Speak into the mic on the Smart Touch Remote to get TV recommendations.</p>\r\n', '<p>The Samsung Smart TV finds the movies and TV shows you like - and more. Speak into the mic on the Smart Touch Remote to get TV recommendations. Use gestures to swipe and navigate within the 5 Smart Hub content panels.</p>\r\n', 1, 2, 'special_deals', NULL, NULL, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Name:</td>\r\n			<td><strong>Mr. Nelson Yu</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Number:</td>\r\n			<td><strong>+65 1234 5678</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>CEA:</td>\r\n			<td><strong>L3008022J/R14506A</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', '1418231570_47_img51.jpg', NULL, '2014-12-11 01:00:38', '2014-12-15 10:56:00', '52-samsung-led-3d-smart-tv', '2899.00', '2300.00', 0, NULL),
(48, 'Viverra Sapien Laoreet Malesuada Nisl', '14 New Industrial Road  #07-02 Hudson Industrial Building  Singapore 536203', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Aliquam vehicula velit eu sem imperdiet pellentesque. Phasellus sit amet quam eu diam interdum interdum ut vel nulla. Vestibulum gravida felis id molestie bibendum. In nec velit at enim blandit placerat id vel dui.</p>\r\n\r\n<p>Duis feugiat nisi ipsum, at gravida lorem posuere ultricies. Etiam laoreet eget ligula in consectetur. Quisque a lobortis tortor, a dignissim enim. Praesent lorem arcu, consequat non ligula non, blandit molestie nisi. Curabitur id nunc lacus. Quisque quis vestibulum neque. Ut fermentum dolor non eros porta efficitur. Nam faucibus libero id efficitur fringilla. Fusce vel nunc leo. Aenean rutrum hendrerit lacus, id accumsan turpis efficitur luctus. Praesent ac placerat leo.</p>\r\n\r\n<p>Aliquam bibendum dapibus dignissim. Curabitur vitae aliquet nunc. Nunc in magna diam. Etiam venenatis accumsan mauris, ut eleifend nibh mattis at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras volutpat fringilla purus rhoncus gravida. Integer non diam justo. Quisque eget dui at ex euismod fermentum ac eu est. Integer bibendum eu orci in scelerisque. Nullam lobortis orci in arcu lacinia luctus. Mauris lacinia lacinia lobortis. Mauris ac dictum quam. Nullam faucibus ligula vel nulla posuere, eu sollicitudin sem mollis. Praesent eleifend tellus erat, ac ultrices turpis eleifend quis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer mollis, tellus ut interdum ultricies, arcu arcu condimentum orci, et ultrices nisl risus id erat.</p>\r\n\r\n<h3><em>&quot;Nunc dictum mi sapien, non dignissim tellus tristique ut. Morbi id nunc finibus, lobortis elit id, auctor nisi. Aliquam enim nibh, dictum a orci sed, congue posuere neque. Phasellus blandit&quot;</em></h3>\r\n', 1, 2, 'lifestyle', '6382 2663', 'info@tongkheng.com.sg', '6286 6778 / 6286 6330', '1418237554_48_img34.jpg', NULL, '2014-12-11 02:41:53', '2014-12-11 15:24:24', 'viverra-sapien-laoreet-malesuada-nisl', '0.00', '0.00', 0, 'www.tongkheng.com.sg'),
(49, '623 Hougang Avenue 8', '<p>Corner unit. stone throw away to public transport service and eateries and market. Unfurnish. Natural breeze. No aircon and attach toilet at bedrooms.. Price negotiatable. Simple and move condition. Key available at 1/10/14. Welcome all to call in for appointment.</p>\r\n', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Property Name:</td>\r\n			<td><strong>623 Hougang Avenue 8</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Property Type:</td>\r\n			<td><strong>HDB Apartment</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Price:</td>\r\n			<td><strong>S$ 1,800 / month Starting from </strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Price (psf):</td>\r\n			<td><strong>S$ 2.43 psf (built-up)</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Floor Area:</td>\r\n			<td><strong>742 sqft / 68.93 sqm (built-up)</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Condition:</td>\r\n			<td><strong>Partially Furnished</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Developer:</td>\r\n			<td><strong>Housing &amp; Development Board</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tenure:</td>\r\n			<td><strong>99-year Leasehold</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Lease Term:</td>\r\n			<td><strong>One year</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 1, 2, 'property_listing', NULL, NULL, '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Name:</td>\r\n			<td><strong>Mr. Nelson Yu</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Number:</td>\r\n			<td><strong>+65 1234 5678</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>CEA:</td>\r\n			<td><strong>L3008022J/R14506A</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', '1418248102_49_img46.jpg', NULL, '2014-12-11 05:48:22', NULL, '623-hougang-avenue-8', '0.00', '0.00', 0, 'north'),
(51, 'News test', 'sdfsdf', '<p>sdfsdf</p>\r\n', 1, 2, 'news', NULL, NULL, NULL, NULL, 28, '2014-12-12 07:54:49', NULL, 'news-test', '0.00', '0.00', 0, NULL),
(52, 'sdfsd', 'fsdf', '<p>sdfsdf</p>\r\n', 1, 2, 'event', NULL, NULL, NULL, NULL, 29, '2014-12-12 07:55:07', NULL, 'sdfsd', '0.00', '0.00', 0, NULL),
(54, 'new 1111', 'new 1111new 1111new 1111new 1111new 1111new 1111new 1111', '<p>new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111new 1111</p>\r\n', 1, 2, 'event', NULL, NULL, NULL, NULL, 31, '2014-12-15 16:58:38', NULL, 'new-1111', '0.00', '0.00', 0, NULL),
(55, 'new title', 'short content', '<p>this is content for event</p>\r\n', 1, 2, 'event', NULL, NULL, NULL, '1418636773_55_hinh-nen-giang-sinh-noel-4.jpg', 32, '2014-12-15 17:46:13', '2014-12-15 17:56:11', 'new-title', '0.00', '0.00', 0, NULL),
(56, 'news', 'fsd', '<p>gdg</p>\r\n', 1, 2, 'news', NULL, NULL, NULL, '1418638619_56_hinh-nen-giang-sinh-noel-4.jpg', 33, '2014-12-15 17:59:05', '2014-12-15 18:16:59', 'news', '0.00', '0.00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_posts_categories`
--

CREATE TABLE IF NOT EXISTS `raovat_posts_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `raovat_roles`
--

CREATE TABLE IF NOT EXISTS `raovat_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `role_short_name` varchar(255) NOT NULL,
  `application_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `raovat_roles`
--

INSERT INTO `raovat_roles` (`id`, `role_name`, `role_short_name`, `application_id`, `status`) VALUES
(1, 'manager', 'Manager', 1, 1),
(2, 'adminstrator', 'Adminstrator', 1, 1),
(3, 'mod', 'Mod', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_roles_menus`
--

CREATE TABLE IF NOT EXISTS `raovat_roles_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=492 ;

--
-- Dumping data for table `raovat_roles_menus`
--

INSERT INTO `raovat_roles_menus` (`id`, `role_id`, `menu_id`) VALUES
(81, 2, 51),
(86, 2, 56),
(91, 1, 60),
(92, 2, 60),
(95, 1, 56),
(108, 1, 68),
(109, 2, 68),
(110, 1, 69),
(111, 2, 69),
(113, 1, 51),
(120, 1, 71),
(121, 2, 71),
(126, 1, 73),
(127, 2, 73),
(148, 1, 64),
(149, 2, 64),
(158, 1, 65),
(159, 2, 65),
(221, 1, 55),
(222, 2, 55),
(223, 1, 77),
(224, 2, 77),
(241, 1, 83),
(242, 2, 83),
(303, 1, 84),
(304, 2, 84),
(315, 1, 102),
(316, 2, 102),
(325, 1, 118),
(326, 2, 118),
(329, 1, 72),
(330, 2, 72),
(387, 2, 53),
(388, 1, 117),
(389, 2, 117),
(390, 1, 82),
(391, 2, 82),
(392, 1, 67),
(393, 2, 67),
(436, 1, 62),
(437, 2, 62),
(438, 1, 66),
(439, 2, 66),
(442, 1, 70),
(443, 2, 70),
(476, 1, 114),
(477, 2, 114),
(478, 1, 149),
(479, 2, 149),
(480, 1, 151),
(481, 2, 151),
(484, 1, 152),
(485, 2, 152),
(486, 1, 148),
(487, 2, 148),
(488, 1, 147),
(489, 2, 147),
(490, 1, 155),
(491, 2, 155);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_seos`
--

CREATE TABLE IF NOT EXISTS `raovat_seos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_tag` varchar(300) NOT NULL,
  `url` varchar(400) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `raovat_seos`
--

INSERT INTO `raovat_seos` (`id`, `title_tag`, `url`, `meta_keyword`, `meta_desc`) VALUES
(6, 'home', 'http://verzview.com/verzgoc/demo/detail/somerset-ii', 'abc', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_settings`
--

CREATE TABLE IF NOT EXISTS `raovat_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `raovat_settings`
--

INSERT INTO `raovat_settings` (`id`, `updated`, `key`, `value`) VALUES
(1, '2012-07-03 02:29:14', 'transportType', 's:4:"smtp";'),
(2, '2014-10-27 02:20:06', 'smtpHost', 's:18:"sg5.verzdesign.com";'),
(3, '2014-10-27 02:20:06', 'smtpUsername', 's:17:"info@verzview.com";'),
(4, '2014-10-27 02:20:06', 'smtpPassword', 's:9:"123123123";'),
(5, '2012-01-31 22:01:43', 'smtpPort', 's:3:"465";'),
(6, '2012-07-03 02:29:14', 'encryption', 's:3:"ssl";'),
(7, '2014-12-15 04:40:07', 'adminEmail', 's:25:"thoa.nh@verzdesign.com.sg";'),
(8, '2014-09-01 02:46:51', 'dateFormat', 's:5:"d/m/Y";'),
(9, '2014-09-01 02:46:51', 'timeFormat', 's:5:"H:i:s";'),
(10, '2014-03-10 20:24:01', 'paypal_email_address', 's:40:"van.nguyenthikhanh-facilitator@gmail.com";'),
(11, '2014-03-09 20:15:03', 'paypalType', 's:4:"test";'),
(12, '2014-07-06 15:17:15', 'paypalURL', 's:0:"";'),
(13, '2014-07-06 15:17:15', 'twitter', 's:18:"http://twitter.com";'),
(14, '2014-12-15 06:28:15', 'facebook', 's:44:"https://www.facebook.com/verzdesignsingapore";'),
(15, '2014-09-08 07:29:38', 'linkedin', 's:25:"https://www.linkedin.com/";'),
(16, '2012-03-21 13:29:44', 'rss', 'N;'),
(17, '2012-07-12 01:02:22', 'meta_description', 's:235:"65 Doctor allows you to set appointments ahead of time with doctors from various medical specialties in Singapore. Let us help you find the right doctor based on your symptoms, required procedures, location, and even insurance company.";'),
(18, '2012-07-12 01:02:22', 'meta_keywords', 's:203:"Singapore Doctors, Online Doctors Singapore, Doctor Appointments Online, Medical Appointments Online, Schedule Doctor Appointments, Find Doctors, Singapore Medical Consultation, Medical Community Online.";'),
(19, '2014-04-26 04:00:39', 'title', 's:6:"Seapex";'),
(20, '2014-12-08 07:15:03', 'last_working', 's:19:"2014-12-08 03:15:03";'),
(21, '2014-10-27 02:20:06', 'autoEmail', 's:17:"info@verzview.com";'),
(32, '2012-06-13 03:52:30', 'image_watermark', 's:21:"bg_13395847462753.gif";'),
(33, '2012-10-07 20:23:53', 'login_limit_times', 's:1:"4";'),
(34, '2012-10-07 20:44:28', 'time_refresh_login', 's:1:"8";'),
(35, '2013-04-12 00:14:21', 'title_all_mail', 's:0:"";'),
(36, '2014-05-07 02:18:35', 'mailchimp_on', 'N;'),
(37, '2014-05-07 02:18:36', 'mailchimp_api_key', 'N;'),
(38, '2014-05-07 02:18:36', 'mailchimp_list_id', 'N;'),
(39, '2014-05-07 02:18:36', 'mailchimp_title_groups', 'N;'),
(40, '2013-04-15 00:28:39', 'server_name', 's:25:"http://localhost/yii_core";'),
(41, '2014-04-18 09:20:00', 'company_name', 's:16:"SEAPEX Singapore";'),
(42, '2014-04-18 09:20:00', 'company_address', 's:63:"20 Upper Circular Road, The River Walk #01-06, Singapore 058416";'),
(43, '2014-04-18 09:24:14', 'copy_right', 's:65:"Copyright © 2014 SEAPEX. All rights reserved. Web Design by Verz";'),
(44, '2014-12-02 08:57:17', 'defaultPageSize', 's:2:"20";'),
(45, '2014-05-07 02:18:35', 'anotherEmail', 's:14:"judy@gmail.com";'),
(46, '2014-06-17 08:34:40', 'paypal_currency', 's:3:"SGD";'),
(47, '2014-05-16 08:13:02', 'paypal_minimum', 's:1:"1";'),
(48, '2014-06-17 08:34:40', 'copyright_on_footer', 's:0:"";'),
(49, '2014-12-08 02:39:05', 'baseUrl', 's:40:"http://verzview.com/verzspeedprintz/demo";'),
(50, '2015-03-23 04:07:20', 'projectName', 's:9:"Rao Vặt";'),
(51, '2015-03-23 04:07:20', 'defaultPageTitle', 's:9:"Rao Vặt";'),
(52, '2015-03-23 04:07:20', 'metaDescription', 's:9:"Rao Vặt";'),
(53, '2015-03-23 04:07:20', 'metaKeywords', 's:9:"Rao Vặt";'),
(54, '2014-12-08 08:24:00', 'googleAnalytics', 's:14:"Design Of Asia";'),
(55, '2014-12-08 08:24:00', 'copyrightOnFooter', 's:177:"<p>Copyright &copy; 2014 Design Of Asia Pte Ltd. All rights reserved. <a href="http://www.verzdesign.com/" target="_blank">Web Design</a> by <span class="verz">Verz</span></p>\r\n";'),
(56, '2014-07-06 15:17:15', 'currencSign', 's:0:"";'),
(57, '2014-07-25 00:27:42', 'loginLimitTimes', 's:1:"5";'),
(58, '2014-07-25 00:27:42', 'timeRefreshLogin', 's:2:"50";'),
(59, '2014-12-12 03:00:41', 'mailSenderName', 's:14:"Design Of Asia";'),
(60, '2014-12-12 03:00:42', 'companyName', 's:23:"Design Of Asia PTE. LTD";'),
(61, '2014-12-08 02:38:50', 'companyAddress', 's:64:"1 Queensway, #03-01K, Queensway Shopping Centre Singapore 149053";'),
(62, '2014-07-06 15:17:15', 'contactFreeText', 's:0:"";'),
(63, '2014-10-30 05:10:57', 'paypalBusinessEmail', 's:23:"vananh_seller@gmail.com";'),
(64, '2014-10-29 07:44:36', 'paypalMode', 's:4:"test";'),
(65, '2014-07-06 15:11:58', 'paypalMinimum', 's:0:"";'),
(66, '2014-10-30 03:57:15', 'paypalCurrency', 's:3:"SGD";'),
(67, '2014-12-11 02:53:48', 'currencySign', 's:1:"$";'),
(68, '2014-09-08 07:29:38', 'googleplus', 's:24:"https://plus.google.com/";'),
(69, '2014-09-25 07:02:16', 'contact_number', 's:14:"+ 65 9234 7675";'),
(70, '2014-09-15 09:26:34', 'assignmentPageSize', 's:1:"3";'),
(71, '2014-09-16 10:22:37', 'tutorPageSize', 's:1:"8";'),
(72, '2014-09-29 03:07:23', 'adminName', 's:7:"Dan Liu";'),
(73, '2014-10-21 06:18:28', 'tumblr', 's:17:"http://tumber.com";'),
(74, '2014-10-21 06:18:28', 'instagram', 's:20:"http://Instagram.com";'),
(75, '2014-10-23 07:02:32', 'mailchimpGroupingId', 'N;'),
(76, '2014-12-02 02:33:21', 'max_quantity_cart', 's:2:"20";'),
(77, '2014-11-28 08:01:27', 'gst', 's:1:"7";'),
(78, '2014-12-08 01:58:41', 'enable_gst', 's:1:"0";'),
(79, '2014-11-07 08:55:02', 'last_working2', 's:19:"2014-11-07 04:55:02";'),
(80, '2014-12-08 02:38:50', 'mobileNumber', 's:12:"65 1234 5678";'),
(81, '2014-12-08 02:38:50', 'phoneNumber', 's:12:"65 1234 5678";'),
(82, '2014-12-08 02:38:50', 'faxNumber', 's:12:"65 1234 5678";'),
(83, '2014-12-01 06:26:00', 'emailContact', 's:26:"enquiry@speedprintz.com.sg";'),
(84, '2014-12-01 06:25:38', 'openHour', 's:102:"<p>Our opening hours are from <strong>9AM to 9PM</strong> excluding Sundays and public holidays.</p>\r\n";'),
(85, '2014-11-28 08:01:27', 'regnNumber', 's:6:"565656";'),
(86, '2014-12-05 04:07:46', 'maxDayDesignSolution', 's:2:"50";'),
(87, '2014-12-05 04:11:15', 'maxDayPrintSolution', 's:2:"50";'),
(88, '2014-12-09 04:36:23', 'slogan', 's:32:"Bridging ideas, inspiring homes.";'),
(89, '2014-12-11 03:21:32', 'map_title', 's:32:"Ark Cleaning Specialists Pte Ltd";'),
(90, '2014-12-11 03:37:42', 'map_address', 's:36:"248 Yishun Avenue 9 Singapore 760248";'),
(91, '2014-12-22 17:11:57', 'f_address', 's:54:"Thằng Bờm AZ P.O. Box 11906, Phoenix AZ 85061  USA";'),
(92, '2014-12-22 17:13:42', 'f_email', 's:22:"  thangbomaz@yahoo.com";'),
(93, '2014-12-22 17:11:57', 'f_phone', 's:55:"Tiếng Việt (602) 465-1253    English (480) 717-7739";'),
(94, '2015-03-23 04:07:20', 'rao_vat_sdt_trai', 's:13:"(480)845-8528";'),
(95, '2015-03-23 04:07:20', 'rao_vat_sdt_phai', 's:13:"(480)845-8528";'),
(96, '2015-03-23 04:07:20', 'rao_vat_email', 's:21:"aaqsolution@gmail.com";'),
(97, '2015-03-23 04:07:20', 'rao_vat_link_tin_tuc', 's:22:"http://thangbomaz.com/";'),
(98, '2015-03-23 04:07:20', 'rao_vat_link_forum', 's:22:"http://thangbomaz.com/";'),
(99, '2015-03-23 04:07:20', 'rao_vat_link_quang_cao', 's:22:"http://thangbomaz.com/";'),
(100, '2015-03-23 06:20:32', 'pagesize_raovat_hot', 's:2:"12";'),
(101, '2015-03-23 08:40:54', 'pagesize_raovat_khac', 's:2:"28";');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_state`
--

CREATE TABLE IF NOT EXISTS `raovat_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `order_display` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `raovat_state`
--

INSERT INTO `raovat_state` (`id`, `name`, `slug`, `status`, `order_display`, `created_date`, `updated_date`) VALUES
(1, 'State 1', 'state-1', 1, 1, '2015-03-23 00:00:00', '2015-03-23 00:00:00'),
(2, 'State-2', 'state-2', 1, 2, '2015-03-23 00:00:00', '2015-03-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_static_banner`
--

CREATE TABLE IF NOT EXISTS `raovat_static_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `order_display` int(11) NOT NULL,
  `name_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `raovat_static_banner`
--

INSERT INTO `raovat_static_banner` (`id`, `image`, `title`, `status`, `content`, `created_date`, `order_display`, `name_banner`, `link`) VALUES
(1, '1419266893_1_0a907ef20975a4b51ec8ea17186fdba30659f84a.jpg', '', 1, '', '2014-09-30 00:00:00', 1, 'topbannerleft', 'http://verzview.com/bds/vrvr'),
(2, '1419266890_2_09e3d084773ddc6198834cfc7cc0203bf3baad92.jpg', '', 1, '', '0000-00-00 00:00:00', 1, 'topbannerright', 'http://verzview.com/bds'),
(3, '1419266153_3_01faf8f58df0e258e99bd25e37c66234a17fb066.jpg', '', 1, '', '0000-00-00 00:00:00', 1, 'rightbanner', 'http://verzview.com/bds/1111'),
(4, '1419266172_4_977b6b34550bcdf593d3e1a652c260b78d7e8465.jpg', '', 1, '', '2014-09-29 07:19:19', 1, 'mainbanner', 'http://verzview.com/bds/222');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_static_block`
--

CREATE TABLE IF NOT EXISTS `raovat_static_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `raovat_static_block`
--

INSERT INTO `raovat_static_block` (`id`, `title`, `content`) VALUES
(1, 'Test', '<p>\r\n	Test</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_subscriber`
--

CREATE TABLE IF NOT EXISTS `raovat_subscriber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `subscriber_group_id` int(6) DEFAULT NULL,
  `subscribed_date` datetime DEFAULT NULL,
  `unsubscribed_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `raovat_subscriber`
--

INSERT INTO `raovat_subscriber` (`id`, `name`, `email`, `status`, `subscriber_group_id`, `subscribed_date`, `unsubscribed_date`) VALUES
(10, 'phan ken', 'phanminhlu@yahoo.com.vn', 1, NULL, '2014-11-12 15:07:58', NULL),
(11, 'thoa.nh@verzdesign.com.sg', 'thoa.nh@verzdesign.com.sg', 1, 1, '2014-11-13 15:27:56', NULL),
(12, 'phan@gmail.com', 'phan@gmail.com', 1, NULL, '2014-11-13 15:36:25', NULL),
(13, 'abc phan', 'nhatchieu_it@yahoo.com.vn', 1, 0, NULL, NULL),
(14, '12345@gmail.com 12345@gmail.com', '12345@gmail.com', 1, 0, NULL, NULL),
(15, 'Anh Nguyen', 'anhthi140190@gmail.com', 1, 1, '2014-12-05 12:23:31', NULL),
(16, 'Van  Anh', 'testverz01@gmail.com', 1, NULL, '2014-12-02 15:10:07', NULL),
(17, 'Beverly ken', 'luminhphan@gmail.com', 0, NULL, '2014-12-02 16:39:34', '2014-12-02 16:40:10'),
(18, 'Merrill Hinton', 'byzofol@hotmail.com', 1, 0, NULL, NULL),
(19, 'Ethan Grant', 'vevamu@gmail.com', 1, 0, NULL, NULL),
(30, NULL, 'tranvo_khoinguyen@yahoo.com', 1, NULL, '2014-12-04 11:02:33', NULL),
(31, 'Mannix Hamilton', 'austin@verzdesign.com', 1, NULL, '2014-12-04 11:16:57', NULL),
(32, 'vesr@gmail.com vesr@gmail.com', 'vesr@gmail.com', 1, 0, NULL, NULL),
(33, 'qe2edwe@gmail.com qe2edwe@gmail.com', 'qe2edwe@gmail.com', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_subscriber_group`
--

CREATE TABLE IF NOT EXISTS `raovat_subscriber_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `raovat_subscriber_group`
--

INSERT INTO `raovat_subscriber_group` (`id`, `name`, `status`) VALUES
(1, 'Public User', 1),
(2, 'Member', 1),
(3, 'Test', 1),
(4, 'v.anh test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_tin_rao_vat`
--

CREATE TABLE IF NOT EXISTS `raovat_tin_rao_vat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `short_content` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `image1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `order_display` int(11) NOT NULL,
  `is_hot` int(11) NOT NULL,
  `is_new` int(11) NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` int(11) NOT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `slug` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `job_id` int(11) NOT NULL,
  `updated_date_status` datetime NOT NULL,
  `view` int(11) NOT NULL,
  `loai_tin` int(11) NOT NULL,
  `post_user_id` int(11) NOT NULL,
  `edit_user_id` int(11) NOT NULL,
  `post_user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `edit_user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `raovat_tin_rao_vat`
--

INSERT INTO `raovat_tin_rao_vat` (`id`, `title`, `short_content`, `content`, `status`, `payment_status`, `image1`, `image2`, `order_display`, `is_hot`, `is_new`, `phone`, `mobile`, `state_id`, `city`, `created_date`, `updated_date`, `slug`, `job_id`, `updated_date_status`, `view`, `loai_tin`, `post_user_id`, `edit_user_id`, `post_user_name`, `edit_user_name`, `address`, `email`) VALUES
(1, 'Cần thợ xây nhà cấp 4 gần TP HCM', 'Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM', '<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<ul>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n</ul>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM&nbsp;</p>\r\n', 1, 0, '1427090854_1_3_21_1328200718_18_1328061995-hoadep5-dulich.jpg', '1427087115_1_0c77835482d4680aea0632f99cfba441b55c4e25.jpg', 1, 1, 0, '01293 423 4321', '01293 423 432', 1, 'HCM City', '2015-03-01 12:48:25', '2015-03-01 14:07:34', 'can-tho-xay-nha-cap-4-gan-tp-hcm', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '', '', '', ''),
(2, 'Title cannot be blank.', 'Title cannot be blank.', '<p><span style="color:#000000;"><span style="font-family: Arial; font-size: 12px; line-height: 17.142858505249px;">Title cannot be blank.</span></span></p>\r\n', 1, 0, '1427089889_2_7e46e9092dd7971033d8cc49964e4431d68e8871.jpg', '1427089890_2_29d16eb13fbf3e96af089c743d44ec5232a7e626.jpg', 1, 0, 0, '', '24543534545', 2, 'wvaew', '2015-03-23 13:51:29', '2015-03-23 13:57:32', 'title-cannot-be-blank', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '', '', '', ''),
(3, 'Cần thợ xây nhà cấp 4 gần TP HCM 123', 'Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM', '<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<ul>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n</ul>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM&nbsp;</p>\r\n', 1, 0, '1427090854_1_3_21_1328200718_18_1328061995-hoadep5-dulich.jpg', '1427087115_1_0c77835482d4680aea0632f99cfba441b55c4e25.jpg', 1, 1, 0, '01293 423 4321', '01293 423 432', 1, 'HCM City', '2015-03-01 12:48:25', '2015-03-01 14:07:34', 'can-tho-xay-nha-cap-4-gan-tp-hcm-123', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '', '', '', ''),
(4, 'Cần thợ xây nhà cấp 4 gần TP HCM123', 'Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM', '<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<ul>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n</ul>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM&nbsp;</p>\r\n', 1, 0, '1427090854_1_3_21_1328200718_18_1328061995-hoadep5-dulich.jpg', '1427087115_1_0c77835482d4680aea0632f99cfba441b55c4e25.jpg', 1, 1, 0, '01293 423 4321', '01293 423 432', 1, 'HCM City', '2015-03-01 12:48:25', '2015-03-01 14:07:34', 'can-tho-xay-nha-cap-4-gan-tp-hcm123', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '', '', '', ''),
(5, 'Cần thợ xây nhà cấp 4 gần TP HCM456', 'Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM', '<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<ul>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n</ul>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM&nbsp;</p>\r\n', 1, 0, '1427090854_1_3_21_1328200718_18_1328061995-hoadep5-dulich.jpg', '1427087115_1_0c77835482d4680aea0632f99cfba441b55c4e25.jpg', 1, 1, 0, '01293 423 4321', '01293 423 432', 1, 'HCM City', '2015-03-01 12:48:25', '2015-03-01 14:07:34', 'can-tho-xay-nha-cap-4-gan-tp-hcm456', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '', '', '', ''),
(6, 'Cần thợ xây nhà cấp 4 gần TP HCMaaa', 'Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM, Cần thợ xây nhà cấp 4 gần TP HCM', '<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<ul>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n	<li>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</li>\r\n</ul>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM</p>\r\n\r\n<p>Cần thợ x&acirc;y nh&agrave; cấp 4 gần TP HCM&nbsp;</p>\r\n', 1, 0, '1427090854_1_3_21_1328200718_18_1328061995-hoadep5-dulich.jpg', '1427087115_1_0c77835482d4680aea0632f99cfba441b55c4e25.jpg', 1, 1, 0, '01293 423 4321', '01293 423 432', 1, 'HCM City', '2015-03-01 12:48:25', '2015-03-01 14:07:34', 'can-tho-xay-nha-cap-4-gan-tp-hcmaaa', 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '', '', '', ''),
(7, 'Nguyen test dang tin rao vặt', 'Nguyen test dang tin rao vặt Nguyen test dang tin rao vặt Nguyen test dang tin rao vặt Nguyen test dang tin rao vặt Nguyen test dang tin rao vặtNguyen test dang', '<p>Nguyen test dang tin rao vặt</p>\r\n\r\n<p>Nguyen test dang tin rao vặt&nbsp;Nguyen test dang tin rao vặt</p>\r\n\r\n<p>Nguyen test dang tin rao vặtNguyen test dang tin rao vặtNguyen test dang tin rao vặtNguyen test dang tin rao vặtNguyen test dang tin rao vặt&nbsp;Nguyen test dang tin rao vặtNguyen test dang tin rao vặtNguyen test dang tin rao vặtNguyen test dang tin rao vặt</p>\r\n', 1, 0, '1429068231_7_images.jpg', '1429068231_7_6cb6c792822a7cf78882529212513e4182448f3d.jpg', 1, 0, 0, '321 432 423 42', '', 1, 'city newyork', '2015-04-15 11:23:51', '2015-04-15 11:27:01', 'nguyen-test-dang-tin-rao-vat', 1, '2015-04-15 11:23:51', 1, 2, 3, 0, 'nguyen admin', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `raovat_users`
--

CREATE TABLE IF NOT EXISTS `raovat_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(200) CHARACTER SET latin1 NOT NULL,
  `password_hash` varchar(100) CHARACTER SET latin1 NOT NULL,
  `temp_password` varchar(30) CHARACTER SET latin1 NOT NULL,
  `title` int(10) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `slug` varchar(350) DEFAULT NULL,
  `login_attemp` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_logged_in` datetime NOT NULL,
  `ip_address` varchar(30) CHARACTER SET latin1 NOT NULL,
  `role_id` int(1) NOT NULL,
  `application_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `gender` varchar(6) CHARACTER SET latin1 DEFAULT 'Male' COMMENT 'Male | Female',
  `phone` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `verify_code` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `area_code_id` int(11) DEFAULT '229',
  `image` varchar(255) DEFAULT NULL,
  `nric` varchar(30) DEFAULT NULL,
  `race_id` int(11) unsigned DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `postal_code` varchar(6) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  `daily_notification` tinyint(1) DEFAULT '0',
  `fb_access_token` text NOT NULL,
  `fb_id` varchar(255) NOT NULL,
  `contact_first_name` varchar(255) DEFAULT NULL,
  `contact_last_name` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `raovat_users`
--

INSERT INTO `raovat_users` (`id`, `username`, `email`, `password_hash`, `temp_password`, `title`, `first_name`, `last_name`, `full_name`, `slug`, `login_attemp`, `created_date`, `last_logged_in`, `ip_address`, `role_id`, `application_id`, `status`, `gender`, `phone`, `fax`, `verify_code`, `area_code_id`, `image`, `nric`, `race_id`, `date_of_birth`, `mobile`, `address1`, `address2`, `postal_code`, `city`, `state`, `last_update_date`, `daily_notification`, `fb_access_token`, `fb_id`, `contact_first_name`, `contact_last_name`, `company`) VALUES
(1, 'manager', 'manager@manager.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, 'manager', 'manager', '', NULL, 5, '2012-06-19 00:00:00', '2014-09-29 22:08:55', '::1', 1, 1, 1, 'FEMALE', '0909999999', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1899-11-30 00:00:00', 0, '', '', NULL, NULL, NULL),
(2, 'admin', 'admin@gmail.com', 'f2d136ea22a5b6e0ed0120a03ab795c2', '123456A', NULL, 'Admin', 'Admin', 'Administrator', NULL, 0, '2012-06-19 00:00:00', '2015-04-10 23:50:51', '::1', 2, 1, 1, 'MALE', '+ 65 9234 7675', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 0, '', '', NULL, NULL, NULL),
(3, 'nguyen', 'nguyen_admin@gmail.com', '27ff2ffe376b2edcc7c2de309173f0d8', 'nguyen', NULL, 'nguyen', 'nguyen', 'nguyen admin', 'nguyen', 0, '2012-06-19 00:00:00', '2015-04-15 10:37:11', '::1', 2, 1, 1, 'MALE', '+ 65 9234 7675', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, 'nguyen', 'nguyen', NULL, NULL, NULL, '0000-00-00 00:00:00', 0, '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `raovat_users_actions`
--

CREATE TABLE IF NOT EXISTS `raovat_users_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `module` varchar(31) DEFAULT NULL,
  `controller` varchar(31) DEFAULT NULL,
  `actions` varchar(256) DEFAULT NULL,
  `type` varchar(31) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_trail`
--

CREATE TABLE IF NOT EXISTS `tbl_audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `old_value` varchar(500) NOT NULL,
  `new_value` varchar(500) NOT NULL,
  `action` varchar(100) NOT NULL,
  `model` varchar(250) NOT NULL,
  `field` varchar(100) NOT NULL,
  `stamp` datetime NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `model_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_audit_trail_old_value` (`old_value`),
  KEY `idx_audit_trail_new_value` (`new_value`),
  KEY `idx_audit_trail_action` (`action`),
  KEY `idx_audit_trail_user_id` (`user_id`),
  KEY `idx_audit_trail_model_id` (`model_id`),
  KEY `idx_audit_trail_model` (`model`),
  KEY `idx_audit_trail_field` (`field`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_audit_trail`
--

INSERT INTO `tbl_audit_trail` (`id`, `old_value`, `new_value`, `action`, `model`, `field`, `stamp`, `user_id`, `model_id`) VALUES
(1, '0', '1', 'CHANGE', 'Users', 'login_attemp', '2015-04-10 23:44:44', '', 2),
(2, '1', '2', 'CHANGE', 'Users', 'login_attemp', '2015-04-10 23:47:02', '', 2),
(3, '2', '0', 'CHANGE', 'Users', 'login_attemp', '2015-04-10 23:47:07', '', 2),
(4, '2014-12-25 12:58:17', '2015-04-10 23:47:07', 'CHANGE', 'Users', 'last_logged_in', '2015-04-10 23:47:07', '', 2),
(5, '2015-04-10 23:47:07', '2015-04-10 23:50:51', 'CHANGE', 'Users', 'last_logged_in', '2015-04-10 23:50:51', '', 2),
(6, '2015-03-23 12:02:36', '2015-04-15 10:37:11', 'CHANGE', 'Users', 'last_logged_in', '2015-04-15 10:37:11', '', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
