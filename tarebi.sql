-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2022 at 02:51 PM
-- Server version: 5.7.37
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tarebi`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_events`
--

CREATE TABLE `action_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_id` bigint(20) UNSIGNED NOT NULL,
  `target_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'running',
  `exception` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `original` mediumtext COLLATE utf8mb4_unicode_ci,
  `changes` mediumtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action_events`
--

INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(1, '95aac4a9-f1a8-447d-b14f-7b6ef5760445', 1, 'Create', 'App\\Models\\Admission', 1, 'App\\Models\\Admission', 1, 'App\\Models\\Admission', 1, '', 'finished', '', '2022-02-23 05:59:24', '2022-02-23 05:59:24', NULL, '{\"title\":\"Entrepreneurs Training\",\"description\":\"<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien turpis, auctor sed pretium vitae, aliquam id est. Duis eu ipsum sapien. Nam accumsan mauris nec cursus sagittis. Proin sit amet tellus odio. Mauris lacinia velit commodo felis sagittis suscipit. Mauris nec mollis arcu, quis ultricies sapien.<\\/div>\",\"period\":\"March 2022 - August 2022\",\"batch\":\"2022-01\",\"opening_date\":\"2022-03-01\",\"closing_date\":\"2022-08-31\",\"status\":\"open\",\"created_by\":1,\"updated_at\":\"2022-02-23T08:59:24.000000Z\",\"created_at\":\"2022-02-23T08:59:24.000000Z\",\"id\":1}'),
(2, '95aace6b-2f5b-4fbb-9128-25b5ae6db65c', 1, 'Create', 'App\\Models\\Admission', 2, 'App\\Models\\Admission', 2, 'App\\Models\\Admission', 2, '', 'finished', '', '2022-02-23 06:26:41', '2022-02-23 06:26:41', NULL, '{\"title\":\"Entrepreneurs Training\",\"description\":\"<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien turpis, auctor sed pretium vitae, aliquam id est. Duis eu ipsum sapien. Nam accumsan mauris nec cursus sagittis. Proin sit amet tellus odio. Mauris lacinia velit commodo felis sagittis suscipit. Mauris nec mollis arcu, quis ultricies sapien.<\\/div>\",\"period\":\"March 2022 - August 2022\",\"batch\":\"2022-02\",\"opening_date\":\"2022-03-01T00:00:00.000000Z\",\"closing_date\":\"2022-08-31T00:00:00.000000Z\",\"status\":\"open\",\"created_by\":1,\"updated_at\":\"2022-02-23T09:26:41.000000Z\",\"created_at\":\"2022-02-23T09:26:41.000000Z\",\"id\":2}'),
(3, '95aacee4-6eaf-45df-a4bd-08b594696ea8', 1, 'Create', 'App\\Models\\User', 2, 'App\\Models\\User', 2, 'App\\Models\\User', 2, '', 'finished', '', '2022-02-23 06:28:00', '2022-02-23 06:28:00', NULL, '{\"name\":\"Benedict Tesha\",\"email\":\"benedict.tesha@jamaatech.com\",\"updated_at\":\"2022-02-23T09:28:00.000000Z\",\"created_at\":\"2022-02-23T09:28:00.000000Z\",\"id\":2}'),
(4, '95aaedf9-c3a3-4928-b0db-a19657fad68a', 2, 'Create', 'App\\Models\\AdmissionCampaign', 1, 'App\\Models\\AdmissionCampaign', 1, 'App\\Models\\AdmissionCampaign', 1, '', 'finished', '', '2022-02-23 07:54:55', '2022-02-23 07:54:55', NULL, '{\"title\":\"Entrepreneurship admission for 2022\",\"description\":\"<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id viverra sem, efficitur lacinia urna. Nam a luctus enim. Nunc non leo enim. Aenean vitae ligula purus.<\\/div>\",\"admission_id\":2,\"staff_id\":1,\"campaign_type\":\"College\",\"institution\":\"Mwanjelwa University\",\"location\":\"Mbeya\",\"campaign_date\":\"2022-02-28T00:00:00.000000Z\",\"potential_students_reached\":\"2000\",\"potential_applicants\":\"1500\",\"created_by\":2,\"updated_at\":\"2022-02-23T10:54:55.000000Z\",\"created_at\":\"2022-02-23T10:54:55.000000Z\",\"id\":1}'),
(9, '95ad3f8a-cc72-40ce-acec-d838c9de78bf', 1, 'Create', 'App\\Models\\Admission', 3, 'App\\Models\\Admission', 3, 'App\\Models\\Admission', 3, '', 'finished', '', '2022-02-24 11:34:39', '2022-02-24 11:34:39', NULL, '{\"title\":\"Ufundi Stadi wa Umeme wa Magari\",\"description\":\"<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in pretium eros. Duis faucibus auctor orci, non vestibulum sem fringilla vel. Nulla porta metus laoreet ultricies pretium<\\/div>\",\"period\":\"March 2021 - August 2021\",\"batch\":\"2021-01\",\"opening_date\":\"2021-03-01T00:00:00.000000Z\",\"closing_date\":\"2021-08-31T00:00:00.000000Z\",\"status\":\"CLOSED\",\"created_by\":1,\"updated_at\":\"2022-02-24T14:34:39.000000Z\",\"created_at\":\"2022-02-24T14:34:39.000000Z\",\"id\":3}'),
(10, '95ad4b35-5fd6-43ac-a15f-b4bb2ca4ede2', 1, 'Create', 'App\\Models\\Assessment', 1, 'App\\Models\\Assessment', 1, 'App\\Models\\Assessment', 1, '', 'finished', '', '2022-02-24 12:07:16', '2022-02-24 12:07:16', NULL, '{\"admission_application_id\":1,\"created_by\":1,\"updated_at\":\"2022-02-24T15:07:16.000000Z\",\"created_at\":\"2022-02-24T15:07:16.000000Z\",\"id\":1}'),
(11, '95ad4e14-3b90-4278-bf2f-573c98e2fb16', 1, 'Update', 'App\\Models\\Assessment', 1, 'App\\Models\\Assessment', 1, 'App\\Models\\Assessment', 1, '', 'finished', '', '2022-02-24 12:15:18', '2022-02-24 12:15:18', '{\"education\":null,\"business_experience\":null}', '{\"education\":\"98\",\"business_experience\":\"95\"}'),
(27, '95af0166-0c40-4b0f-8f33-039ea1b67ffb', 1, 'Update', 'App\\Models\\ApplicationComment', 1, 'App\\Models\\ApplicationComment', 1, 'App\\Models\\ApplicationComment', 1, '', 'finished', '', '2022-02-25 08:32:32', '2022-02-25 08:32:32', '{\"comment\":\"Okay\"}', '{\"comment\":\"Okay, let\'s you have rejected this application, what is your plan?\"}'),
(28, '95af0197-637d-481c-8dd4-f19c12cdbf4a', 1, 'Update', 'App\\Models\\ApplicationComment', 1, 'App\\Models\\ApplicationComment', 1, 'App\\Models\\ApplicationComment', 1, '', 'finished', '', '2022-02-25 08:33:05', '2022-02-25 08:33:05', '{\"comment\":\"Okay, let\'s you have rejected this application, what is your plan?\"}', '{\"comment\":\"Okay, let us say you have rejected this application, what is your plan?\"}'),
(30, '95af022a-e38c-4fa0-a0a3-2445eeed1ac7', 1, 'Create', 'App\\Models\\ApplicationComment', 2, 'App\\Models\\ApplicationComment', 2, 'App\\Models\\ApplicationComment', 2, '', 'finished', '', '2022-02-25 08:34:41', '2022-02-25 08:34:41', NULL, '{\"comment\":\"I see another screening on the same application.. Okay, no problem then!\",\"admission_application_id\":1,\"created_by\":1,\"updated_at\":\"2022-02-25T11:34:41.000000Z\",\"created_at\":\"2022-02-25T11:34:41.000000Z\",\"id\":2}'),
(38, '95af1168-48b5-4c2c-94cc-989e1b028ca3', 2, 'Update', 'App\\Models\\Admission', 2, 'App\\Models\\Admission', 2, 'App\\Models\\Admission', 2, '', 'finished', '', '2022-02-25 09:17:18', '2022-02-25 09:17:18', '{\"title\":\"Entrepreneurs Training\"}', '{\"title\":\"TAREBI 2022 Cohort\"}'),
(39, '95af11fd-1970-4962-ad9f-9fb01cd60632', 2, 'Update', 'App\\Models\\AdmissionCampaign', 1, 'App\\Models\\AdmissionCampaign', 1, 'App\\Models\\AdmissionCampaign', 1, '', 'finished', '', '2022-02-25 09:18:56', '2022-02-25 09:18:56', '{\"title\":\"Entrepreneurship admission for 2022\"}', '{\"title\":\"Awareness Worshop\"}'),
(42, '95b7648e-2a89-4881-bb99-4297ed5fed0a', 2, 'Update', 'App\\Models\\Admission', 3, 'App\\Models\\Admission', 3, 'App\\Models\\Admission', 3, '', 'finished', '', '2022-03-01 12:36:25', '2022-03-01 12:36:25', '{\"batch\":\"2021-01\"}', '{\"batch\":\"AD22-01\"}'),
(43, '95b764a2-6b46-4d10-83c0-8d7dee8f5806', 2, 'Update', 'App\\Models\\Admission', 2, 'App\\Models\\Admission', 2, 'App\\Models\\Admission', 2, '', 'finished', '', '2022-03-01 12:36:39', '2022-03-01 12:36:39', '{\"batch\":\"2022-02\"}', '{\"batch\":\"AD22-02\"}'),
(44, '95b764b9-2402-4d80-9e21-27d67396104a', 2, 'Update', 'App\\Models\\Admission', 1, 'App\\Models\\Admission', 1, 'App\\Models\\Admission', 1, '', 'finished', '', '2022-03-01 12:36:54', '2022-03-01 12:36:54', '{\"batch\":\"2022-01\"}', '{\"batch\":\"AD22-03\"}'),
(45, '95b76ca9-35b7-43e5-8e3b-b6d2a15dab42', 2, 'Create', 'App\\Models\\ApplicationComment', 6, 'App\\Models\\ApplicationComment', 6, 'App\\Models\\ApplicationComment', 6, '', 'finished', '', '2022-03-01 12:59:05', '2022-03-01 12:59:05', NULL, '{\"comment\":\"Just another comment\",\"admission_application_id\":1,\"created_by\":2,\"updated_at\":\"2022-03-01T15:59:05.000000Z\",\"created_at\":\"2022-03-01T15:59:05.000000Z\",\"id\":6}'),
(46, '95badec3-2822-4c48-9b5e-f847da684c0e', 1, 'Update', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, '', 'finished', '', '2022-03-03 06:05:37', '2022-03-03 06:05:37', '{\"email1\":null,\"email2\":null}', '{\"email1\":\"chriskikoti@gmail.com\",\"email2\":\"chris.kikoti@jamaatech.com\"}'),
(47, '95badf1a-7b60-4c80-aae4-2eb84b51f0df', 1, 'Update', 'App\\Models\\AdmissionCampaign', 1, 'App\\Models\\AdmissionCampaign', 1, 'App\\Models\\AdmissionCampaign', 1, '', 'finished', '', '2022-03-03 06:06:35', '2022-03-03 06:06:35', '{\"name\":\"Awareness Worshop\"}', '{\"name\":\"Awareness Workshop\"}'),
(48, '95bae19e-9726-4e28-bbc7-7ec7d59855c0', 1, 'Create', 'App\\Models\\Program', 1, 'App\\Models\\Program', 1, 'App\\Models\\Program', 1, '', 'finished', '', '2022-03-03 06:13:37', '2022-03-03 06:13:37', NULL, '{\"name\":\"Fabulous Program for Entrepreneurs and Businessmen\",\"description\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien turpis, auctor sed pretium vitae, aliquam id est. Duis eu ipsum sapien. Nam accumsan mauris nec cursus sagittis. Proin sit amet tellus odio. Mauris lacinia velit commodo felis sagittis suscipit. Mauris nec mollis arcu, quis ultricies sapien.\",\"updated_at\":\"2022-03-03T09:13:37.000000Z\",\"created_at\":\"2022-03-03T09:13:37.000000Z\",\"id\":1}'),
(50, '95bae2ff-d230-468a-82ba-c39f811e6a20', 1, 'Update', 'App\\Models\\Admission', 3, 'App\\Models\\Admission', 3, 'App\\Models\\Admission', 3, '', 'finished', '', '2022-03-03 06:17:28', '2022-03-03 06:17:28', '{\"program_id\":null}', '{\"program_id\":1}'),
(51, '95bae358-d57b-4773-befc-8de55d8ecb48', 1, 'Update', 'App\\Models\\Admission', 2, 'App\\Models\\Admission', 2, 'App\\Models\\Admission', 2, '', 'finished', '', '2022-03-03 06:18:27', '2022-03-03 06:18:27', '{\"program_id\":null}', '{\"program_id\":1}'),
(52, '95bae36c-e48e-4a05-9b71-356d7e75e55c', 1, 'Update', 'App\\Models\\Admission', 1, 'App\\Models\\Admission', 1, 'App\\Models\\Admission', 1, '', 'finished', '', '2022-03-03 06:18:40', '2022-03-03 06:18:40', '{\"program_id\":null}', '{\"program_id\":1}'),
(53, '95bae3fc-e57e-4ad4-a586-7e0ff7390f62', 1, 'Select', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-03 06:20:14', '2022-03-03 06:20:14', NULL, NULL),
(54, '95bb2b88-bef1-4fab-98b5-a2c0c091d846', 1, 'Update', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, '', 'finished', '', '2022-03-03 09:40:18', '2022-03-03 09:40:18', '{\"number\":null}', '{\"number\":\"AP\\/BD101\"}'),
(55, '95bf1522-8473-4249-812f-de2cc3d9631d', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-05 08:20:58', '2022-03-05 08:20:58', NULL, NULL),
(58, '95bf25a3-59b9-40bf-a7c4-da5bbc46c746', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-05 09:07:07', '2022-03-05 09:07:07', NULL, NULL),
(59, '95bf25f4-17d0-480b-853e-f1e850adfb91', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-05 09:08:00', '2022-03-05 09:08:00', NULL, NULL),
(60, '95bf291b-b68c-4438-95a9-fdd115666a76', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-05 09:16:49', '2022-03-05 09:16:49', NULL, NULL),
(61, '95c4daf6-2fc5-47f5-b9d5-31f7b688c5c3', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 05:13:16', '2022-03-08 05:13:16', NULL, NULL),
(62, '95c4de6b-7bc2-46a1-a904-e2ae61883fc4', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 05:22:57', '2022-03-08 05:22:57', NULL, NULL),
(63, '95c4e649-6fdb-46ce-a119-947f076eb48e', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 05:44:57', '2022-03-08 05:44:57', NULL, NULL),
(64, '95c4e816-37f1-4144-9d1e-533b85004f95', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 05:49:58', '2022-03-08 05:49:59', NULL, NULL),
(65, '95c4e85d-aff2-4375-a6e4-80232f64ae08', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 05:50:45', '2022-03-08 05:50:45', NULL, NULL),
(66, '95c4ec2c-2dbe-457e-b560-a6c0312f7534', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 06:01:24', '2022-03-08 06:01:24', NULL, NULL),
(67, '95c4ee44-a7f3-4e7d-8715-94c4377714e6', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 06:07:16', '2022-03-08 06:07:16', NULL, NULL),
(68, '95c4f06f-d63c-418b-8be2-204188cbb568', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 06:13:19', '2022-03-08 06:13:19', NULL, NULL),
(69, '95c4fb06-c58f-4bba-82ee-371e6d2e7a59', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 06:42:56', '2022-03-08 06:42:56', NULL, NULL),
(70, '95c4fd59-6cc2-4d9f-80b6-1ce978a2ecae', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 06:49:26', '2022-03-08 06:49:26', NULL, NULL),
(71, '95c4fd6c-3161-43a3-a684-61f439495e09', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 06:49:38', '2022-03-08 06:49:38', NULL, NULL),
(72, '95c50514-49ad-4fa0-938a-872f2c5ecf4d', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 07:11:03', '2022-03-08 07:11:03', NULL, NULL),
(73, '95c50521-9ad3-4537-9959-07e0c370acb2', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 07:11:11', '2022-03-08 07:11:11', NULL, NULL),
(74, '95c5155c-23ac-443c-9108-7cbf2b7a24eb', 1, 'Create', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, '', 'finished', '', '2022-03-08 07:56:34', '2022-03-08 07:56:34', NULL, '{\"number\":\"AP\\/BD101\\/002\",\"admission_id\":1,\"submitted_on\":\"2022-03-06\",\"first_name\":\"Jane\",\"middle_name\":\"Smith\",\"last_name\":\"Doe\",\"gender\":\"Mwanamke\",\"date_of_birth\":\"2000-03-01T00:00:00.000000Z\",\"marital_status\":\"Sijaoa\\/Olewa\",\"id_type\":\"Pasipoti\",\"id_number\":\"PPS1120\",\"region\":\"Iringa\",\"district\":\"Kilolo\",\"ward\":\"Frelimo\",\"village_street\":\"Frelimo A\",\"phone1\":\"+255811222111\",\"phone2\":null,\"email1\":\"janedoe@email.com\",\"email2\":null,\"education\":\"Chuo cha Kati\\/Kikuu\",\"education_other\":\"PhD - Psychology\",\"communication_subscription_method\":\"Simu\",\"communication_subscription_method_other\":\"Email\",\"previous_subscription_tarebi_services\":\"Hapana\",\"have_dependants\":\"Ndiyo\",\"number_of_dependants\":\"14\",\"physical_disability\":\"Hapana\",\"physical_disability_type\":null,\"business_average_income\":\"499997\",\"other_income_activities\":null,\"other_income_activities_income\":null,\"employed\":\"Hapana\",\"employer_name\":null,\"have_capital_asset\":\"Ndiyo\",\"capital_asset_value\":\"7999997\",\"have_savings\":\"Ndiyo\",\"savings_amount\":\"1250000\",\"savings_method\":\"Benki\",\"savings_method_other\":null,\"have_loan\":\"Hapana\",\"total_loan_amount\":null,\"loan_source\":null,\"loan_source_other\":null,\"have_group\":\"Hapana\",\"group_details\":null,\"doing_business\":\"Ndiyo\",\"business_type\":\"Software\",\"is_business_yours\":\"Hapana\",\"is_business_registered\":\"Hapana\",\"business_registration_type\":null,\"business_registration_type_other\":null,\"business_under_registration_process\":\"Hapana\",\"business_employees_count\":null,\"trained_business_through_incubation\":\"Hapana\",\"trained_by_tarebi_incubation\":\"Hapana\",\"other_training_from_other_institutes\":null,\"preferred_training_from_tarebi\":\"Huduma kwa Wateja na Kutafuta Masoko\",\"preferred_training_from_tarebi_other\":null,\"have_smartphone\":\"Ndiyo\",\"created_by\":1,\"updated_at\":\"2022-03-08T10:56:34.000000Z\",\"created_at\":\"2022-03-08T10:56:34.000000Z\",\"id\":2}'),
(75, '95c51602-71d1-4909-9595-18b43f5c63ab', 1, 'Approve', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'a:0:{}', 'finished', '', '2022-03-08 07:58:23', '2022-03-08 07:58:23', NULL, NULL),
(76, '95c51602-71d1-4909-9595-18b43f5c63ab', 1, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-08 07:58:23', '2022-03-08 07:58:23', NULL, NULL),
(77, '95c719af-1726-437a-b151-e2fdc604e80b', 1, 'Create', 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 1, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 1, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 1, '', 'finished', '', '2022-03-09 08:00:19', '2022-03-09 08:00:19', NULL, '{\"comment\":\"This application has to be modified\",\"commentable_id\":1,\"commenter_id\":1,\"updated_at\":\"2022-03-09T11:00:19.000000Z\",\"created_at\":\"2022-03-09T11:00:19.000000Z\",\"id\":1}'),
(78, '95c720e1-1ae1-47dc-b720-87c11fafe215', 1, 'Create', 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 2, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 2, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 2, '', 'finished', '', '2022-03-09 08:20:26', '2022-03-09 08:20:26', NULL, '{\"comment\":\"All in all I am grateful it worked\",\"commentable_id\":1,\"commenter_id\":1,\"updated_at\":\"2022-03-09T11:20:26.000000Z\",\"created_at\":\"2022-03-09T11:20:26.000000Z\",\"id\":2}'),
(79, '95c72191-c602-4f56-a647-3585ae7856ae', 2, 'Create', 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 3, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 3, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 3, '', 'finished', '', '2022-03-09 08:22:22', '2022-03-09 08:22:22', NULL, '{\"comment\":\"This application was selected, assessment was properly done. Excellent\",\"commentable_id\":1,\"commenter_id\":2,\"updated_at\":\"2022-03-09T11:22:22.000000Z\",\"created_at\":\"2022-03-09T11:22:22.000000Z\",\"id\":3}'),
(80, '95c721e3-5a74-438b-874f-efc3e3c37bdf', 2, 'Create', 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 4, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 4, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 4, '', 'finished', '', '2022-03-09 08:23:15', '2022-03-09 08:23:15', NULL, '{\"comment\":\"Why is this application still pending? No one attended it since yesterday. Make sure all screening is done today!\",\"commentable_id\":2,\"commenter_id\":2,\"updated_at\":\"2022-03-09T11:23:15.000000Z\",\"created_at\":\"2022-03-09T11:23:15.000000Z\",\"id\":4}'),
(81, '95c7227d-6c28-4fba-a28c-80f002eea127', 2, 'Assess', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'a:2:{s:9:\"education\";s:2:\"51\";s:19:\"business_experience\";s:2:\"35\";}', 'finished', '', '2022-03-09 08:24:56', '2022-03-09 08:24:56', NULL, NULL),
(82, '95c722a0-406c-44c8-815b-aed1916d958d', 2, 'Select', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'a:0:{}', 'finished', '', '2022-03-09 08:25:19', '2022-03-09 08:25:19', NULL, NULL),
(83, '95c722bf-f802-4259-9acd-af7417dc5281', 2, 'Approve', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'a:0:{}', 'finished', '', '2022-03-09 08:25:40', '2022-03-09 08:25:40', NULL, NULL),
(84, '95c722bf-f802-4259-9acd-af7417dc5281', 2, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-09 08:25:40', '2022-03-09 08:25:40', NULL, NULL),
(85, '95c72b73-28aa-4743-8b01-aac39af33ab8', 2, 'Create', 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 5, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 5, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 5, '', 'finished', '', '2022-03-09 08:49:59', '2022-03-09 08:49:59', NULL, '{\"comment\":\"Comments section works fine\",\"commentable_id\":1,\"commenter_id\":2,\"updated_at\":\"2022-03-09T11:49:59.000000Z\",\"created_at\":\"2022-03-09T11:49:59.000000Z\",\"id\":5}'),
(86, '95c72baa-0f61-4d5c-b978-6a499d7727db', 2, 'Approve', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'a:0:{}', 'finished', '', '2022-03-09 08:50:35', '2022-03-09 08:50:35', NULL, NULL),
(87, '95c72baa-0f61-4d5c-b978-6a499d7727db', 2, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-09 08:50:35', '2022-03-09 08:50:35', NULL, NULL),
(92, '95c73184-2609-4ef1-9d76-f66bd71ae89c', 2, 'Approve', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'a:0:{}', 'finished', '', '2022-03-09 09:06:57', '2022-03-09 09:06:57', NULL, NULL),
(93, '95c73184-2609-4ef1-9d76-f66bd71ae89c', 2, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-09 09:06:57', '2022-03-09 09:06:57', NULL, NULL),
(94, '95c73519-f40b-4a3a-8ae3-8103bd2e451a', 2, 'Approve', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'a:0:{}', 'finished', '', '2022-03-09 09:16:59', '2022-03-09 09:16:59', NULL, NULL),
(95, '95c73519-f40b-4a3a-8ae3-8103bd2e451a', 2, 'Approve', 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'App\\Models\\AdmissionApplication', 1, 'a:0:{}', 'finished', '', '2022-03-09 09:16:59', '2022-03-09 09:16:59', NULL, NULL),
(96, '95c745e6-72cb-44d5-9f93-a7407a65be7f', 1, 'Approve Applications', 'App\\Models\\Admission', 1, 'App\\Models\\Admission', 1, 'App\\Models\\Admission', 1, 'a:0:{}', 'finished', '', '2022-03-09 10:03:57', '2022-03-09 10:03:57', NULL, NULL),
(97, '95c74dd2-3dce-4429-9672-0cbc2519092a', 1, 'Create', 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 6, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 6, 'KirschbaumDevelopment\\NovaComments\\Models\\Comment', 6, '', 'finished', '', '2022-03-09 10:26:06', '2022-03-09 10:26:06', NULL, '{\"comment\":\"Okay boss, working on it asap!!!\",\"commentable_id\":2,\"commenter_id\":1,\"updated_at\":\"2022-03-09T13:26:06.000000Z\",\"created_at\":\"2022-03-09T13:26:06.000000Z\",\"id\":6}'),
(98, '95c74f51-f0af-4a70-b017-645364d1266e', 1, 'Reject', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'a:0:{}', 'finished', '', '2022-03-09 10:30:18', '2022-03-09 10:30:18', NULL, NULL),
(99, '95c74f5b-3bf1-4e29-bfe6-9c70e4a981ee', 1, 'Select', 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'App\\Models\\AdmissionApplication', 2, 'a:0:{}', 'finished', '', '2022-03-09 10:30:24', '2022-03-09 10:30:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admissions`
--

CREATE TABLE `admissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_date` date NOT NULL,
  `closing_date` date NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `status` enum('Open','Closed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `locked` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admissions`
--

INSERT INTO `admissions` (`id`, `name`, `program_id`, `description`, `period`, `batch`, `opening_date`, `closing_date`, `created_by`, `status`, `locked`, `created_at`, `updated_at`) VALUES
(1, 'Entrepreneurs Training', 1, '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien turpis, auctor sed pretium vitae, aliquam id est. Duis eu ipsum sapien. Nam accumsan mauris nec cursus sagittis. Proin sit amet tellus odio. Mauris lacinia velit commodo felis sagittis suscipit. Mauris nec mollis arcu, quis ultricies sapien.</div>', 'March 2022 - August 2022', 'AD22-03', '2022-03-01', '2022-08-31', 1, 'Open', '0', '2022-02-23 05:59:24', '2022-03-09 10:03:57'),
(2, 'TAREBI 2022 Cohort', 1, '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien turpis, auctor sed pretium vitae, aliquam id est. Duis eu ipsum sapien. Nam accumsan mauris nec cursus sagittis. Proin sit amet tellus odio. Mauris lacinia velit commodo felis sagittis suscipit. Mauris nec mollis arcu, quis ultricies sapien.</div>', 'March 2022 - August 2022', 'AD22-02', '2022-03-01', '2022-08-31', 1, 'Open', '0', '2022-02-23 06:26:41', '2022-03-03 06:18:27'),
(3, 'Ufundi Stadi wa Umeme wa Magari', 1, '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in pretium eros. Duis faucibus auctor orci, non vestibulum sem fringilla vel. Nulla porta metus laoreet ultricies pretium</div>', 'March 2021 - August 2021', 'AD22-01', '2021-03-01', '2021-08-31', 1, 'Closed', '0', '2022-02-24 11:34:39', '2022-03-03 06:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `admission_applications`
--

CREATE TABLE `admission_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` bigint(20) DEFAULT NULL,
  `number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ward` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `communication_subscription_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `communication_subscription_method_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_subscription_tarebi_services` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `have_dependants` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_dependants` int(11) DEFAULT NULL,
  `physical_disability` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `physical_disability_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_average_income` decimal(12,2) DEFAULT NULL,
  `other_income_activities` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_income_activities_income` decimal(12,2) DEFAULT NULL,
  `employed` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `have_capital_asset` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capital_asset_value` decimal(12,2) DEFAULT NULL,
  `have_savings` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `savings_amount` decimal(12,2) DEFAULT NULL,
  `savings_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `savings_method_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `have_loan` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_loan_amount` decimal(12,2) DEFAULT NULL,
  `loan_source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_source_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `have_group` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_details` text COLLATE utf8mb4_unicode_ci,
  `doing_business` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_business_yours` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_business_registered` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_registration_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_registration_type_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_under_registration_process` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_employees_count` int(11) DEFAULT NULL,
  `trained_business_through_incubation` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trained_by_tarebi_incubation` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_training_from_other_institutes` text COLLATE utf8mb4_unicode_ci,
  `preferred_training_from_tarebi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred_training_from_tarebi_other` text COLLATE utf8mb4_unicode_ci,
  `have_smartphone` enum('Ndiyo','Hapana') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_complete` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `submitted_on` date DEFAULT NULL,
  `status` enum('Pending','Screened','Selected','Rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `created_by` bigint(20) DEFAULT NULL,
  `locked` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_applications`
--

INSERT INTO `admission_applications` (`id`, `admission_id`, `number`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `region`, `district`, `ward`, `village_street`, `id_type`, `id_number`, `marital_status`, `education`, `education_other`, `phone1`, `phone2`, `email1`, `email2`, `communication_subscription_method`, `communication_subscription_method_other`, `previous_subscription_tarebi_services`, `have_dependants`, `number_of_dependants`, `physical_disability`, `physical_disability_type`, `business_average_income`, `other_income_activities`, `other_income_activities_income`, `employed`, `employer_name`, `have_capital_asset`, `capital_asset_value`, `have_savings`, `savings_amount`, `savings_method`, `savings_method_other`, `have_loan`, `total_loan_amount`, `loan_source`, `loan_source_other`, `have_group`, `group_details`, `doing_business`, `business_type`, `is_business_yours`, `is_business_registered`, `business_registration_type`, `business_registration_type_other`, `business_under_registration_process`, `business_employees_count`, `trained_business_through_incubation`, `trained_by_tarebi_incubation`, `other_training_from_other_institutes`, `preferred_training_from_tarebi`, `preferred_training_from_tarebi_other`, `have_smartphone`, `is_complete`, `submitted_on`, `status`, `created_by`, `locked`, `created_at`, `updated_at`) VALUES
(1, 1, 'AP/BD101/001', 'John', 'Smith', 'Doe', 'Mwanaume', '1990-02-08', 'Dar es Salaam', 'Kinondoni', 'Mbezi Beach', 'Tanki Bovu', 'Leseni ya udereva', '400093883', 'Sijaoa/olewa', 'Chuo cha kati/kikuu', 'PhD', '0811324554', '0822087121', 'chriskikoti@gmail.com', 'chris.kikoti@jamaatech.com', 'Barua pepe', 'Meseji', 'Hapana', 'Ndiyo', 15, 'Hapana', 'Sina ulemavu', '8000000.00', 'Software', '12000000.00', 'Ndiyo', 'Jamaa Technologies', 'Ndiyo', '200000000.00', 'Ndiyo', '40000000.00', 'Benki', 'Mobile Money', 'Hapana', '0.00', 'Nyingine', 'Sikopi', 'Ndiyo', 'Kuunda Software', 'Ndiyo', 'Software', 'Ndiyo', 'Ndiyo', 'Usajili wa Jina la Biashara (Brella)', 'Private Limited Company', 'Hapana', 5, 'Hapana', 'Hapana', 'Mauzo na masoko', 'Kuandaa mpango wa biashara', 'Kuuza', 'Ndiyo', '1', '2022-02-24', 'Selected', 1, '0', '2022-02-24 07:32:25', '2022-03-09 10:03:57'),
(2, 1, 'AP/BD101/002', 'Jane', 'Smith', 'Doe', 'Mwanamke', '2000-03-01', 'Iringa', 'Kilolo', 'Frelimo', 'Frelimo A', 'Pasipoti', 'PPS1120', 'Sijaoa/Olewa', 'Chuo cha Kati/Kikuu', 'PhD - Psychology', '+255811222111', NULL, 'janedoe@email.com', NULL, 'Simu', 'Email', 'Hapana', 'Ndiyo', 14, 'Hapana', NULL, '499997.00', NULL, NULL, 'Hapana', NULL, 'Ndiyo', '7999997.00', 'Ndiyo', '1250000.00', 'Benki', NULL, 'Hapana', NULL, NULL, NULL, 'Hapana', NULL, 'Ndiyo', 'Software', 'Hapana', 'Hapana', NULL, NULL, 'Hapana', NULL, 'Hapana', 'Hapana', NULL, 'Huduma kwa Wateja na Kutafuta Masoko', NULL, 'Ndiyo', '1', '2022-03-06', 'Selected', 1, '0', '2022-03-08 07:56:34', '2022-03-09 10:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `admission_campaigns`
--

CREATE TABLE `admission_campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `admission_id` bigint(20) DEFAULT NULL,
  `staff_id` bigint(20) DEFAULT NULL,
  `campaign_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign_date` date NOT NULL,
  `potential_students_reached` int(11) DEFAULT NULL,
  `potential_applicants` int(11) DEFAULT NULL,
  `status` enum('New','Executed','Discarded') COLLATE utf8mb4_unicode_ci DEFAULT 'New',
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_campaigns`
--

INSERT INTO `admission_campaigns` (`id`, `name`, `description`, `admission_id`, `staff_id`, `campaign_type`, `institution`, `location`, `campaign_date`, `potential_students_reached`, `potential_applicants`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Awareness Workshop', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris id viverra sem, efficitur lacinia urna. Nam a luctus enim. Nunc non leo enim. Aenean vitae ligula purus.</div>', 2, 1, 'College', 'Mwanjelwa University', 'Mbeya', '2022-02-28', 2000, 1500, 'New', 2, '2022-02-23 07:54:55', '2022-03-03 06:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `application_comments`
--

CREATE TABLE `application_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_application_id` bigint(20) DEFAULT NULL,
  `posted_by` bigint(20) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_comments`
--

INSERT INTO `application_comments` (`id`, `admission_application_id`, `posted_by`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Okay, let us say you have rejected this application, what is your plan?', '2022-02-25 08:21:19', '2022-02-25 08:33:05'),
(2, 1, 1, 'I see another screening on the same application.. Okay, no problem then!', '2022-02-25 08:34:41', '2022-02-25 08:34:41'),
(3, 1, 2, 'Whose application is this, I see so much logs - to and fro', '2022-02-25 09:03:22', '2022-02-25 09:03:22'),
(4, 1, 2, 'This is my comment, we need to take a closer look on our decision making', '2022-02-25 09:07:27', '2022-02-25 09:07:27'),
(5, 1, 2, 'A new comment', '2022-02-25 09:08:38', '2022-02-25 09:08:38'),
(6, 1, 2, 'Just another comment', '2022-03-01 12:59:05', '2022-03-01 12:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_application_id` bigint(20) DEFAULT NULL,
  `education` int(11) DEFAULT NULL,
  `business_experience` int(11) DEFAULT NULL,
  `screening_score` double(3,1) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `admission_application_id`, `education`, `business_experience`, `screening_score`, `remarks`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 88, 98, 93.0, NULL, 1, '2022-02-25 08:02:13', '2022-02-25 08:34:08'),
(2, 2, 51, 35, 43.0, NULL, 2, '2022-03-09 08:24:56', '2022-03-09 08:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_01_000000_create_action_events_table', 1),
(4, '2019_05_10_000000_add_fields_to_action_events_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2022_02_23_064112_create_admissions_table', 2),
(12, '2022_02_23_094001_create_admission_campaigns_table', 3),
(17, '2022_02_24_073100_create_admission_applications_table', 4),
(21, '2022_02_25_100853_create_application_comments_table', 6),
(22, '2022_02_24_144307_create_assessments_table', 7),
(23, '2022_03_03_081103_create_programs_table', 8),
(24, '2022_03_04_081322_create_students_table', 9),
(25, '2020_01_01_000000_create_widgets_table', 10),
(26, '2019_04_09_211908_create_comments_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `nova_comments`
--

CREATE TABLE `nova_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `commenter_id` int(10) UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nova_comments`
--

INSERT INTO `nova_comments` (`id`, `commentable_type`, `commentable_id`, `commenter_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 'This application has to be modified', '2022-03-09 08:00:19', '2022-03-09 08:00:19'),
(2, NULL, 1, 1, 'All in all I am grateful it worked', '2022-03-09 08:20:26', '2022-03-09 08:20:26'),
(3, NULL, 1, 2, 'This application was selected, assessment was properly done. Excellent', '2022-03-09 08:22:22', '2022-03-09 08:22:22'),
(4, NULL, 2, 2, 'Why is this application still pending? No one attended it since yesterday. Make sure all screening is done today!', '2022-03-09 08:23:15', '2022-03-09 08:23:15'),
(5, NULL, 1, 2, 'Comments section works fine', '2022-03-09 08:49:59', '2022-03-09 08:49:59'),
(6, NULL, 2, 1, 'Okay boss, working on it asap!!!', '2022-03-09 10:26:06', '2022-03-09 10:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `locked` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `number`, `description`, `locked`, `created_at`, `updated_at`) VALUES
(1, 'Business Skills Development', 'BD101', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien turpis, auctor sed pretium vitae, aliquam id est. Duis eu ipsum sapien. Nam accumsan mauris nec cursus sagittis. Proin sit amet tellus odio. Mauris lacinia velit commodo felis sagittis suscipit. Mauris nec mollis arcu, quis ultricies sapien.', '0', '2022-03-03 06:13:37', '2022-03-03 06:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admission_id` bigint(20) DEFAULT NULL,
  `admission_application_id` bigint(20) DEFAULT NULL,
  `program_id` bigint(20) DEFAULT NULL,
  `number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ward` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Selected','Enrolled') COLLATE utf8mb4_unicode_ci DEFAULT 'Selected',
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Christopher Kikoti', 'chriskikoti@gmail.com', NULL, '$2y$10$SSn0Vsdnte.EzO0f37c7GuQ1ZW5DQ5zqErk3.zR8QQyT1c3DtiDvO', 'bjqjQsE5xcTtA1Bkqa6wanAnq7tpYsTuv5WCy3uoMKWRQVYbWDfZVzuECaur', '2022-02-23 04:30:09', '2022-02-23 04:30:09'),
(2, 'Benedict Tesha', 'benedict.tesha@jamaatech.com', NULL, '$2y$10$NCyuD/NURSu9WaVrt60cQ.qsutyEWNe38H0CJJkPOGFdlt0iyRYey', 'LHQeKYTyC454DBmff2BapoFdbnRRAHht2vUxCCzyxNzbyi8TrpEz2UOp1OVG', '2022-02-23 06:28:00', '2022-02-23 06:28:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_events`
--
ALTER TABLE `action_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_events_actionable_type_actionable_id_index` (`actionable_type`,`actionable_id`),
  ADD KEY `action_events_batch_id_model_type_model_id_index` (`batch_id`,`model_type`,`model_id`),
  ADD KEY `action_events_user_id_index` (`user_id`);

--
-- Indexes for table `admissions`
--
ALTER TABLE `admissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_applications`
--
ALTER TABLE `admission_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_campaigns`
--
ALTER TABLE `admission_campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_comments`
--
ALTER TABLE `application_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nova_comments`
--
ALTER TABLE `nova_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nova_comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_events`
--
ALTER TABLE `action_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `admissions`
--
ALTER TABLE `admissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admission_applications`
--
ALTER TABLE `admission_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admission_campaigns`
--
ALTER TABLE `admission_campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `application_comments`
--
ALTER TABLE `application_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `nova_comments`
--
ALTER TABLE `nova_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
