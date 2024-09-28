-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 01:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'firos', '$2y$10$NWML3Mj6GTqcOZ/OsfBVtOe2ZXXDp4XWiqJV5g4Vuec1mYicuM3P2', 'firos@gmail.com'),
(2, 'gopi', '$2y$10$ihUjBrmOt9vatOp5KK5QR.mCxEZWD/T15FFiuR8wxiX2PF4PfD30m', 'gopi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_fee` decimal(10,2) NOT NULL,
  `status` enum('Pending','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `order_date` datetime DEFAULT current_timestamp(),
  `admin_update` text DEFAULT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `quantity`, `total_amount`, `shipping_fee`, `status`, `order_date`, `admin_update`, `phone_number`) VALUES
(76, 10, 20, 2, 138000.00, 0.00, 'Delivered', '2024-09-19 13:42:15', 'shippiing', '54554545'),
(77, 10, 20, 5, 345049.00, 49.00, 'Delivered', '2024-09-19 13:48:39', 'thanks', ''),
(78, 10, 23, 2, 158048.00, 48.00, 'Pending', '2024-09-19 15:04:16', 'ok daa !', ''),
(79, 9, 22, 1, 59000.00, 0.00, 'Pending', '2024-09-19 15:07:00', NULL, '5678998'),
(80, 9, 26, 2, 6020.00, 22.00, 'Pending', '2024-09-19 15:08:05', NULL, ''),
(81, 11, 21, 3, 297000.00, 0.00, 'Delivered', '2024-09-19 21:06:50', 'Gopi Krishnan Good .... !', '+91 06788 76'),
(82, 11, 27, 1, 800035.00, 35.00, 'Pending', '2024-09-20 19:46:52', NULL, ''),
(83, 11, 23, 2, 158000.00, 0.00, 'Pending', '2024-09-20 19:48:53', NULL, 't6766776'),
(84, 12, 20, 1, 69000.00, 0.00, 'Pending', '2024-09-21 11:42:47', 'working1', '454545'),
(85, 12, 26, 2, 6049.00, 51.00, 'Pending', '2024-09-22 15:10:29', 'ok daa !', ''),
(86, 12, 22, 2, 118000.00, 0.00, 'Pending', '2024-09-22 15:19:57', 'poda', '5678998'),
(87, 12, 20, 1, 69030.00, 30.00, 'Pending', '2024-09-23 20:50:06', NULL, ''),
(88, 12, 32, 2, 156000.00, 0.00, 'Pending', '2024-09-23 21:35:24', NULL, '+91 009 849 84'),
(89, 13, 33, 3, 510000.00, 0.00, 'Pending', '2024-09-25 14:04:40', NULL, '+91 009 849 84'),
(90, 12, 37, 2, 1864.00, 66.00, 'Delivered', '2024-09-28 09:16:07', 'Thank you for shopping with us ! New Products coming soon !', ''),
(91, 12, 42, 2, 380030.00, 32.00, 'Delivered', '2024-09-28 11:01:18', 'Thank you for shopping with us ! New Products coming soon !', ''),
(92, 12, 36, 1, 2999.00, 0.00, 'Pending', '2024-09-28 14:20:02', NULL, '56767'),
(93, 14, 41, 2, 180060.00, 62.00, 'Delivered', '2024-09-28 15:28:28', 'Thank you for shopping with us ! New Products coming soon !', ''),
(94, 14, 51, 1, 50050.00, 51.00, 'Pending', '2024-09-28 15:33:58', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` enum('iphone','samsung','redmi','wired_headphone','wireless_headphone','airpods') NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `main_image_url` varchar(255) DEFAULT NULL,
  `sub_image1_url` varchar(255) DEFAULT NULL,
  `sub_image2_url` varchar(255) DEFAULT NULL,
  `sub_image3_url` varchar(255) DEFAULT NULL,
  `sub_image4_url` varchar(255) DEFAULT NULL,
  `key_features` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `image_url`, `page_url`, `main_image_url`, `sub_image1_url`, `sub_image2_url`, `sub_image3_url`, `sub_image4_url`, `key_features`) VALUES
(34, 'Apple AirPods', 'The Apple AirPods (3rd Generation) are true wireless earbuds that offer an exceptional audio experience, improved battery life, and seamless integration with Apple devices. With spatial audio and a sleek design, they provide an immersive listening experience for music, calls, and more.', 29000.00, 'airpods', 'https://www.cashit.in/Images/060920212849900877Apple-AirPods-1st-Gen-2.png', NULL, 'https://www.cashit.in/Images/060920212849900877Apple-AirPods-1st-Gen-2.png', 'https://www.cashit.in/Images/060920212849900877Apple-AirPods-1st-Gen-2.png', 'https://images.macrumors.com/t/URu7wcrlM4PYR3ih6bIoq84wxUo=/1600x0/article-new/2020/04/AirPods-PRo-isolated.png', 'https://d61s2hjse0ytn.cloudfront.net/card_image/None/Post_Template_12.webp', 'https://os-wordpress-media.s3.ap-south-1.amazonaws.com/blog/wp-content/uploads/2022/09/07232054/Apple-AirPods-Pro-2nd-Gen-Features-1024x576.jpg', 'Spatial Audio: Personalized spatial audio with dynamic head tracking delivers a theater-like sound experience.\r\nAdaptive EQ: Automatically tunes music to the shape of your ear, providing a customized listening experience.\r\nLong Battery Life: Up to 6 hours of listening time on a single charge, with up to 30 hours using the MagSafe Charging Case.\r\nWater and Sweat Resistance: IPX4-rated, making them perfect for workouts and outdoor use.\r\nImproved Design: Shorter stem design for a more discreet look, with a comfortable and secure fit.\r\nEnhanced Microphone Quality: Built-in microphones with beamforming technology for clear voice calls and Siri commands.\r\nSeamless Connectivity: Quick pairing with Apple devices and easy switching between iPhone, iPad, Mac, and Apple Watch.'),
(35, 'Spatial Earpod 2E400', 'The Spatial Earpod 2E400 are true wireless earbuds that offer an exceptional audio experience, improved battery life, and seamless integration with Apple devices. With spatial audio and a sleek design, they provide an immersive listening experience for music, calls, and more.', 1700.00, 'airpods', NULL, NULL, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSyNx8VFTaRBvTQ0HcBGcpkihbuhVBp9VtCA&s', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSyNx8VFTaRBvTQ0HcBGcpkihbuhVBp9VtCA&s', 'https://hottu.pk/wp-content/uploads/2023/02/P73-max-1.png', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnFNWaMtMxzvEIagKcp27kNXEz95U6mZwF1w&s', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXdc-1aFokLmF-kaQ38YHAx22x-OWfFZDrYg&s', 'Long Battery Life: Up to 6 hours of listening time on a single charge, with up to 30 hours using the MagSafe Charging Case.\r\nWater and Sweat Resistance: IPX4-rated, making them perfect for workouts and outdoor use.\r\nImproved Design: Shorter stem design for a more discreet look, with a comfortable and secure fit.\r\nEnhanced Microphone Quality: Built-in microphones with beamforming technology for clear voice calls and Siri commands.\r\nSeamless Connectivity: Quick pairing with Apple devices and easy switching between iPhone, iPad, Mac, and Apple Watch.\r\nTouch Controls: Intuitive force sensor controls for music playback, calls, and activating Siri.\r\nFind My Integration: Helps locate your AirPods with precision tracking through the Find My app.\r\nMagSafe Charging: Compatible with MagSafe chargers for easy and convenient wireless charging.'),
(36, 'Samure 2nd Edition', 'Samura EarPods are wired earbuds designed with a comfortable, universal fit and enhanced audio quality. Featuring an iconic design, they offer clear sound and easy access to playback controls, making them ideal for everyday use.', 2999.00, 'airpods', NULL, NULL, 'https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1697623007/Croma%20Assets/Entertainment/Wireless%20Earbuds/Images/258707_tct7td.png', 'https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1697623007/Croma%20Assets/Entertainment/Wireless%20Earbuds/Images/258707_tct7td.png', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF8EC_2fFyR8X3xegmBNonFEEroxJNIV0fuA&s', 'https://computerspace.in/cdn/shop/files/CTP-46351_AEM_PDP_ECOM_Black-1_2_422be62f-d6c8-43ab-9e5b-5b116e359e75.png?v=1714547512&width=1946', 'https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1695802095/Croma%20Assets/Entertainment/Wireless%20Earbuds/Images/301699_utkgch.png', 'Adaptive EQ: Automatically tunes music to the shape of your ear, providing a customized listening experience.\r\nLong Battery Life: Up to 6 hours of listening time on a single charge, with up to 30 hours using the MagSafe Charging Case.\r\nWater and Sweat Resistance: IPX4-rated, making them perfect for workouts and outdoor use.\r\nImproved Design: Shorter stem design for a more discreet look, with a comfortable and secure fit.\r\nEnhanced Microphone Quality: Built-in microphones with beamforming technology for clear voice calls and Siri commands.\r\nSeamless Connectivity: Quick pairing with Apple devices and easy switching between iPhone, iPad, Mac, and Apple Watch.\r\nTouch Controls: Intuitive force sensor controls for music playback, calls, and activating Siri.\r\nFind My Integration: Helps locate your AirPods with precision tracking through the Find My app.'),
(37, 'Noise SonicWave ', 'SonicWave Pulse is a locally made, budget-friendly wireless earbud set designed for everyday use. With a sleek design, impressive battery life, and clear audio quality, they deliver great value for money and cater to users looking for affordable yet reliable wireless earbuds.', 899.00, 'airpods', 'https://www.gonoise.com/cdn/shop/files/1_68af1967-8a79-4516-9873-211acfe237e2.png?v=1724763666', NULL, 'https://www.gonoise.com/cdn/shop/files/1_68af1967-8a79-4516-9873-211acfe237e2.png?v=1724763666', 'https://www.gonoise.com/cdn/shop/files/1_68af1967-8a79-4516-9873-211acfe237e2.png?v=1724763666', 'https://media-ik.croma.com/prod/https://media.croma.com/image/upload/v1718790087/Croma%20Assets/Entertainment/Wireless%20Earbuds/Images/300412_0_qlvfju.png', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuLBj7cJ3WsfRFiir_cz-DjPAaotPzYX-uCg&s', 'https://makmobile.in/cdn/shop/files/special-features2.png?v=1684929981&width=1445', 'High-Quality Sound: Equipped with powerful drivers that provide clear sound with deep bass, making it ideal for music, calls, and podcasts.\r\nErgonomic Design: Lightweight and designed to fit comfortably in your ears, perfect for extended use without discomfort.\r\nLong Battery Life: Up to 5 hours of playtime on a single charge, with an additional 15 hours provided by the compact charging case.\r\nBluetooth 5.0: Stable and fast connection with a range of up to 10 meters, ensuring smooth pairing with your smartphone or laptop.\r\nTouch Controls: Intuitive touch sensors for play/pause, track change, and answering calls, offering a hands-free experience.\r\nWater-Resistant: IPX4 rating makes them resistant to sweat and light rain, suitable for workouts and outdoor activities.\r\nNoise Isolation: In-ear design provides passive noise isolation, reducing ambient noise for an immersive audio experience.'),
(38, 'iPhone 12 Pro', 'The iPhone 12 Pro is a premium smartphone from Apple, known for its sleek design, powerful performance, and advanced camera capabilities. Featuring a stunning 6.1-inch Super Retina XDR display, it offers vibrant colors and deep blacks for an immersive viewing experience. The phone is powered by the A14 Bionic chip, which delivers exceptional speed and efficiency for multitasking, gaming, and high-end applications.', 89000.00, 'iphone', 'https://inventstore.in/wp-content/uploads/2023/04/iPhone_13_Midnight_.webp', NULL, 'https://inventstore.in/wp-content/uploads/2023/04/iPhone_13_Midnight_.webp', 'https://inventstore.in/wp-content/uploads/2023/04/iPhone_13_Midnight_.webp', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQ2hu4ULNjKPmUzePqPU4jGe743OKU2GFxRQ&s', 'https://cdnmedia.placewellretail.com/pub/media/catalog/product/cache/d2f155c8ae3423b25125c336aa39579e/i/p/iphone_15_pink_1.webp', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoMCirAqANYvw3pGwKG3eFwdUshFRU0fKTdQ&s', 'Display: 6.1-inch Super Retina XDR display with vibrant colors and sharp resolution.\r\nProcessor: A14 Bionic chip for fast performance and energy efficiency.\r\nCamera System: Triple 12MP cameras (ultra-wide, wide, and telephoto) for professional-quality photos and videos.\r\nNight Mode: Enhanced Night mode for better low-light photography across all lenses.\r\nVideo Recording: Dolby Vision HDR video recording up to 4K at 60 fps.\r\nDesign: Sleek, durable design with Ceramic Shield front cover for 4x better drop performance.\r\n5G Connectivity: Supports 5G for faster downloads and streaming.\r\nMagSafe: MagSafe technology for easy wireless charging and accessory attachment'),
(39, 'Neo Buds', 'Experience unparalleled audio quality and comfort with our latest earpods, featuring advanced noise cancellation, Bluetooth connectivity for easy pairing, and a sleek design that ensures a snug fit for all-day wear.', 899.00, 'airpods', NULL, NULL, 'https://techcor.co.za/wp-content/uploads/2023/10/R6-white-1.png', 'https://techcor.co.za/wp-content/uploads/2023/10/R6-white-1.png', 'https://www.pro-bems.com/IMAGES/images_1/OTLTWSDC-HQUINN/m/OTLTWSDC-HQUINN_3.png', 'https://justincaseitalia.it/cdn/shop/products/EARPODS-FULL-BLUE-1.png?v=1704891179&width=1024', 'https://5.imimg.com/data5/SELLER/Default/2022/5/FM/OA/CO/151783082/web-capture-6-5-2022-132037-.jpeg', 'Audio Quality: High-fidelity sound with deep bass and crisp highs.\r\nBattery Life: Up to 10 hours of playtime on a single charge, with an additional 20 hours using the charging case.\r\nCharging Case: Compact and convenient charging case for easy storage and quick recharges.\r\nMicrophone: Built-in microphone for hands-free calls and voice commands.\r\nWater Resistance: IPX4 rated for sweat and water resistance, making them suitable for workouts.\r\nTouch Controls: Easy touch controls for music playback and calls.'),
(40, 'iphone X', 'The iPhone X redefines the smartphone experience with its stunning 5.8-inch Super Retina display, delivering vibrant colors and incredible detail. Designed with a glass front and back, it not only looks sleek but is also wireless charging compatible. Powered by the A11 Bionic chip, the iPhone X ensures lightning-fast performance and efficiency. With dual 12MP cameras, it captures stunning photos and videos, including amazing low-light shots. Face ID provides a secure and intuitive way to unlock your phone, making the iPhone X a perfect blend of innovation and elegance.', 45999.00, 'iphone', NULL, NULL, 'https://images-cdn.ubuy.co.in/6536a14f83435f22a774da72-pre-owned-apple-iphone-x-64gb-silver.jpg', 'https://images-cdn.ubuy.co.in/6536a14f83435f22a774da72-pre-owned-apple-iphone-x-64gb-silver.jpg', 'https://media.croma.com/image/upload/v1704794279/Croma%20Assets/Communication/Mobiles/Images/250954_1_saxkiz.png', 'https://media.croma.com/image/upload/v1704794323/Croma%20Assets/Communication/Mobiles/Images/250952_7_gjzhuw.png', 'https://ic.maxabout.us//misc/infographics/mobile-phone-infographics//Apple-iPhone-X.jpg', 'Display: 5.8-inch Super Retina display with HDR and True Tone technology.\r\nProcessor: A11 Bionic chip for superior performance and efficiency.\r\nCamera: Dual 12MP rear cameras with optical image stabilization and 4K video recording capabilities.\r\nFace ID: Secure facial recognition technology for unlocking your phone and making payments.\r\nWireless Charging: Supports Qi wireless charging for added convenience.\r\nStorage Options: Available in 64GB and 256GB variants to meet your storage needs.\r\niOS: Runs on the latest iOS, offering a user-friendly interface and access to a wide range of apps.'),
(41, 'iphone 12 Pro Max', 'The iPhone 12 Pro Max is the pinnacle of Apple\'s smartphone technology, featuring a stunning 6.7-inch Super Retina XDR display that brings your content to life with incredible clarity and vibrant colors. Encased in a premium stainless steel frame and durable Ceramic Shield front, this device is built to withstand the rigors of daily use. Powered by the A14 Bionic chip, it delivers lightning-fast performance for gaming, photography, and multitasking. With an advanced triple-camera system, including Night mode and ProRAW capabilities, the iPhone 12 Pro Max captures breathtaking photos and videos in any lighting condition. Plus, 5G connectivity ensures you stay connected at unprecedented speeds.', 89999.00, 'iphone', NULL, NULL, 'https://lmt-web.mstatic.lv/eshop/11470/conversions/iPhone-12-Pro-Max_gold_front_b-860.webp', 'https://lmt-web.mstatic.lv/eshop/11470/conversions/iPhone-12-Pro-Max_gold_front_b-860.webp', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOTi4PMEi8QFAMDlLU-iXonT7230W3KIpNcA&s', 'https://images.dailyobjects.com/marche/product-images/1101/dailyobjects-game-mode-black-hybrid-clear-case-cover-for-iphone-12-pro-max-images/designer-hybrid-clear-case-iphone-12-pro-10.png?tr=cm-pad_resize,v-3,w-412,h-490,dpr-2,q-60', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtJGfwOXjPtUnlvmMjWDAEHdXUDMyU47RhtA&s', 'Display: 6.7-inch Super Retina XDR display with HDR and true-to-life colors.\r\nProcessor: A14 Bionic chip for exceptional performance and power efficiency.\r\nCamera System: Triple 12MP cameras (Ultra Wide, Wide, and Telephoto) with Night mode, Deep Fusion, and Smart HDR 3 for stunning photos and 4K Dolby Vision HDR recording.\r\n5G Connectivity: Enjoy blazing-fast downloads and high-quality streaming with 5G technology.\r\nCeramic Shield: Front cover with four times better drop performance.\r\nMagSafe: Magnetic attachment for compatible accessories and wireless charging.\r\nStorage Options: Available in 128GB, 256GB, and 512GB storage capacities.\r\niOS: Runs on iOS, providing a seamless user experience with access to a vast app ecosystem.'),
(42, 'iphone 16 ', 'The iPhone 16 redefines the smartphone experience with its sleek design and cutting-edge technology. Featuring a stunning 6.1-inch Super Retina XDR display, the iPhone 16 offers vibrant colors and sharp details for an immersive viewing experience. Powered by the latest A17 Bionic chip, this device ensures lightning-fast performance, making multitasking and gaming smoother than ever. The advanced dual-camera system enhances photography capabilities, allowing you to capture stunning images with Night mode and improved low-light performance. ', 189999.00, 'iphone', NULL, NULL, 'https://inventstore.in/wp-content/uploads/2024/07/63.webp', 'https://inventstore.in/wp-content/uploads/2024/07/63.webp', 'https://static.standard.co.uk/2024/09/10/13/29/iPhone-16-Reveal.png?width=1200&height=1200&fit=crop', 'https://images.macrumors.com/t/7eRyaIDFFAh9Tc_8NhASvppl0_U=/1600x/article-new/2023/03/iphone-16-blue-roundup-header.png', 'https://img.etimg.com/thumb/width-1600,height-900,imgsize-1007270,resizemode-75,msid-113204485/magazines/panache/apple-iphone-16-and-iphone-16-plus-launch-price-specs-features-comparison-everything-you-need-to-know.jpg', 'Display: 6.1-inch Super Retina XDR display with HDR support and True Tone technology for an enhanced visual experience.\r\nProcessor: A17 Bionic chip for unparalleled performance and efficiency in demanding applications.\r\nCamera System: Dual 12MP camera system with Night mode, Deep Fusion, and Smart HDR 4 for exceptional photography and videography.\r\n5G Connectivity: Ultra-fast 5G capabilities for quicker downloads, streaming, and online gaming.\r\nDurability: Ceramic Shield front cover provides improved drop resistance and durability.\r\nMagSafe: Compatible with MagSafe accessories for seamless attachment and wireless charging.\r\nStorage Options: Available in 128GB, 256GB, and 512GB storage configurations.'),
(43, 'iphone 14 Pro', 'The iPhone 14 Pro elevates mobile technology with its sophisticated design and innovative features. Sporting a 6.1-inch Super Retina XDR display with ProMotion technology, it delivers an incredibly smooth and responsive viewing experience. The powerful A16 Bionic chip ensures exceptional performance for all your favorite apps and games, while the advanced triple-camera system enables you to capture stunning photos and videos in any lighting condition. With enhanced low-light performance and ProRAW capabilities, your creative possibilities are limitless.', 139999.00, 'iphone', 'https://media.croma.com/image/upload/v1662655547/Croma%20Assets/Communication/Mobiles/Images/261970_blsyac.png', NULL, 'https://media.croma.com/image/upload/v1662655547/Croma%20Assets/Communication/Mobiles/Images/261970_blsyac.png', 'https://media.croma.com/image/upload/v1662655547/Croma%20Assets/Communication/Mobiles/Images/261970_blsyac.png', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmhqS0aDHGGSDp_SUAzBhjxc_pGHbcshN-Dg&s', 'https://craftbymerlin.com/cdn/shop/products/Deep_Purple-Img1_8353bf1b-5d2e-4edb-b180-ccc59f37447a.png?v=1662890839', 'https://os-wordpress-media.s3.ap-south-1.amazonaws.com/blog/wp-content/uploads/2022/09/08000850/Apple-iPhone-14-Pro-And-Apple-iPhone-14-Pro-Plus-Features-1024x576.jpg', 'Display: 6.1-inch Super Retina XDR display with ProMotion technology for up to 120Hz refresh rate and HDR support.\r\nProcessor: A16 Bionic chip for outstanding speed, efficiency, and responsiveness in any task.\r\nCamera System: Triple-camera system with 48MP main camera, 12MP ultra-wide, and 12MP telephoto lenses, offering advanced photography features like Night mode and ProRAW.\r\n5G Connectivity: Supports super-fast 5G for enhanced download speeds and seamless streaming.\r\nDynamic Island: Innovative new design feature for alerts and activities, providing a unique interactive experience.\r\nBattery Life: All-day battery life with intelligent battery management to keep you connected longer.'),
(44, 'Samsung A52', 'The Samsung Galaxy A52 combines elegance with powerful performance in a mid-range smartphone. Featuring a vibrant 6.5-inch Super AMOLED display with a 90Hz refresh rate, it provides a smooth and immersive viewing experience for everything from gaming to streaming. Powered by the Qualcomm Snapdragon 720G processor, the A52 delivers reliable performance for multitasking and gaming. Its versatile quad-camera setup, including a 64MP main camera, allows you to capture stunning photos and videos in any setting. With a large 4500mAh battery and 25W fast charging, you can enjoy all-day use without worrying about running out of power.', 35999.00, 'samsung', NULL, NULL, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQU34ruCnBd9OuAbSAw7-iP-qRxuYn5VkZY2w&s', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQU34ruCnBd9OuAbSAw7-iP-qRxuYn5VkZY2w&s', 'https://ohlocal-media.s3.amazonaws.com/media/SM126986SA.jpg', 'https://images.dailyobjects.com/marche/product-images/1101/dailyobjects-pastel-peach-glass-case-cover-for-samsung-galaxy-a52-images/DailyObjects-Pastel-Peach-Glass-Case-Cover-For-Samsung-Galaxy-A52.png?tr=cm-pad_resize,v-3', 'https://r2.community.samsung.com/t5/image/serverpage/image-id/1828717i2B4B1838C6B644CA/image-size/large?v=v2&px=999', 'Display: 6.5-inch FHD+ Super AMOLED display with a 90Hz refresh rate for smooth scrolling and vibrant visuals.\r\nProcessor: Qualcomm Snapdragon 720G for efficient performance in multitasking and gaming.\r\nCamera System: Quad-camera setup with a 64MP main camera, 12MP ultra-wide, 5MP macro, and 5MP depth sensors for versatile photography.\r\nBattery: 4500mAh battery with 25W fast charging for all-day use and quick power-ups.\r\nStorage Options: Available with 128GB or 256GB of internal storage, expandable up to 1TB via microSD card.\r\nOS: Runs on One UI 3.1 based on Android 11, offering a user-friendly interface and extensive customization options.\r\nDesign: Sleek and modern design with a premium finish, available in a variety of attractive colors.'),
(45, 'Samsung A72', 'The Samsung Galaxy A72 is a feature-rich smartphone that offers a perfect blend of style, performance, and versatility. It boasts a stunning 6.7-inch Super AMOLED display with a 90Hz refresh rate, ensuring vibrant visuals and smooth interactions. Powered by the Qualcomm Snapdragon 720G processor, the A72 delivers robust performance for gaming, multitasking, and streaming. The impressive quad-camera system, highlighted by a 64MP main lens, captures stunning photos and videos in various conditions. With a large 5000mAh battery, you can enjoy extended usage without the need for frequent recharging.\r\n\r\n', 59999.00, 'samsung', NULL, NULL, 'https://cdn.mos.cms.futurecdn.net/sYfASKVzUWmijPZJVB5AF9.png', 'https://cdn.mos.cms.futurecdn.net/sYfASKVzUWmijPZJVB5AF9.png', 'https://www.cashit.in/Images/240820214055674538130720210231677696233630_10_ceegxd-(1).png', 'https://www.janado.de/cdn/shop/products/samsung-galaxy-a72-128gb-awesome-white-pn_1219x.png?v=1704260673', 'https://r2.community.samsung.com/t5/image/serverpage/image-id/1828729iB141ED03702D1D18/image-size/large?v=v2&px=999', 'Storage Options: Available with 128GB or 256GB of internal storage, expandable up to 1TB via microSD card.\r\nOS: Runs on One UI 3.1 based on Android 11, offering a smooth user experience with customizable features.\r\nDesign: Sleek and modern design with a premium glass finish, available in a range of stylish colors.'),
(46, 'Samsung Galaxy S23', 'The Samsung Galaxy S23 Ultra redefines premium smartphone technology with its unparalleled performance, cutting-edge features, and stunning design. Featuring a vast 6.8-inch Dynamic AMOLED 2X display with a 120Hz refresh rate, it delivers breathtaking visuals with vibrant colors and deep blacks. Powered by the latest Snapdragon 8 Gen 2 processor, the S23 Ultra ensures lightning-fast performance for gaming, multitasking, and demanding applications. The exceptional camera system, including a 200MP main lens, allows you to capture professional-quality photos and videos in any environment. With a robust 5000mAh battery and intelligent power management, the S23 Ultra keeps you connected throughout the day, making it the ultimate flagship device for those who demand the best.\r\n\r\n', 39999.00, 'samsung', 'https://iclusters.in/cdn/shop/files/IMG_1119.webp?v=1714807831', NULL, 'https://iclusters.in/cdn/shop/files/IMG_1119.webp?v=1714807831', 'https://iclusters.in/cdn/shop/files/IMG_1119.webp?v=1714807831', 'https://images.samsung.com/is/image/samsung/p6pim/sg/2302/gallery/sg-galaxy-s23-s918-sm-s918bzewxsp-534857015', 'https://s7d1.scene7.com/is/image/dish/2023-samsung-gs-23-ultra-black-front-pen?$ProductBase$&fmt=webp-alpha', 'https://www.91-cdn.com/hub/wp-content/uploads/2023/02/Samsung-Galaxy-S23-series-launch.png', 'Display: 6.8-inch QHD+ Dynamic AMOLED 2X display with a 120Hz refresh rate for smooth scrolling and immersive visuals.\r\nProcessor: Snapdragon 8 Gen 2 chipset for exceptional performance and efficiency in demanding tasks.\r\nCamera System: Quad-camera setup with a 200MP main camera, 12MP ultra-wide, dual 10MP telephoto lenses (3x and 10x optical zoom) for stunning photography and versatility.\r\nBattery: 5000mAh battery with 45W fast charging and 15W wireless charging capabilities for extended usage and quick recharging.\r\nStorage Options: Available in 256GB, 512GB, and 1TB storage variants, with support for expandable storage via microSD card.\r\nOS: Runs on One UI 5.1 based on Android 13, providing a smooth and customizable user experience.\r\nDesign: Premium glass and metal design with Gorilla Glass Victus 2 protection, available in a variety of striking colors.\r\nS Pen Support: Integrated S Pen with advanced functionality for note-taking, drawing, and enhanced productivity.\r\nConnectivity: 5G support, Wi-Fi 6E, Bluetooth 5.3, and Ultra-Wideband (UWB) technology for cutting-edge connectivity options'),
(47, 'Samsung Galaxy S20', 'The Samsung Galaxy S20 brings cutting-edge technology and elegant design to the forefront of mobile innovation. Featuring a stunning 6.2-inch QHD+ Dynamic AMOLED 2X display with a 120Hz refresh rate, it provides ultra-smooth scrolling and vibrant visuals for an immersive viewing experience. Powered by the Exynos 990 (or Snapdragon 865, depending on the region), the Galaxy S20 offers exceptional performance for gaming, multitasking, and everyday tasks. The advanced triple-camera system, including a 12MP wide, 64MP telephoto, and 12MP ultra-wide lens, allows you to capture stunning photos and 8K videos with ease. With a 4000mAh battery and intelligent power management, the Galaxy S20 is designed to keep up with your busy lifestyle.', 49999.00, 'samsung', NULL, NULL, 'https://5.imimg.com/data5/ECOM/Default/2023/12/369493386/HH/BK/TN/47699750/samsung-s20-fe.png', 'https://5.imimg.com/data5/ECOM/Default/2023/12/369493386/HH/BK/TN/47699750/samsung-s20-fe.png', 'https://images.samsung.com/is/image/samsung/levant-galaxy-s20-sm-g980-sm-g980fzadmid-frontcosmicgray-226691177', 'https://communicationsplus.co.uk/wp-content/uploads/2021/03/Samsung-s21-6.png', 'https://i.pinimg.com/originals/b0/4e/8a/b04e8a9b0f81253823f39a73fadfd010.png', 'Display: 6.2-inch QHD+ Dynamic AMOLED 2X display with 120Hz refresh rate for fluid visuals and vibrant colors.\r\nProcessor: Exynos 990 (international) or Snapdragon 865 (USA) for powerful performance and efficiency.\r\nCamera System: Triple-camera setup featuring a 12MP wide, 64MP telephoto (3x hybrid zoom), and 12MP ultra-wide lenses for versatile photography.\r\nVideo Recording: Capable of recording 8K video at 24fps for stunning cinematic content.\r\nBattery: 4000mAh battery with 25W fast charging, 15W wireless charging, and 4.5W reverse wireless charging for all-day power.\r\nStorage Options: Available in 128GB of internal storage, expandable via microSD card (up to 1TB).\r\nOS: Runs on One UI 2.0 based on Android 10, offering a customizable and user-friendly experience.\r\nDesign: Sleek and premium design with Gorilla Glass 6 on both front and back for enhanced durability.\r\nConnectivity: 5G support, Wi-Fi 6, Bluetooth 5.0, and NFC for fast connectivity options.'),
(48, 'Samsung A32', 'The Samsung Galaxy A32 is a versatile mid-range smartphone that combines style, performance, and an impressive camera system. It features a vibrant 6.4-inch FHD+ Super AMOLED display with a 90Hz refresh rate, delivering smooth scrolling and stunning visuals for an immersive viewing experience. Powered by the MediaTek Helio G80 processor, the A32 ensures efficient performance for everyday tasks, gaming, and multitasking. The quad-camera system, which includes a 64MP main camera, 8MP ultra-wide lens, 5MP macro lens, and 5MP depth sensor, allows users to capture stunning photos in various settings. With a long-lasting 5000mAh battery, the Galaxy A32 is designed to keep you connected throughout the day.\r\n\r\n', 59999.00, 'samsung', NULL, NULL, 'https://media.croma.com/image/upload/v1710958099/Croma%20Assets/Communication/Mobiles/Images/305472_0_twhdqm.png', 'https://media.croma.com/image/upload/v1710958099/Croma%20Assets/Communication/Mobiles/Images/305472_0_twhdqm.png', 'https://www.cashit.in/Images/130720211020297026Main-Galaxy-A32-A52-A72_combo.png', 'https://images.jdmagicbox.com/quickquotes/images_main/galaxy-m55-5g-ram-8-gb-128-gb-light-green-272786841-p1phhudw.png', 'https://static.hub.91mobiles.com/wp-content/uploads/2021/02/samsung-galaxy-a32-5g-specs-image.jpg?tr=w-360,c-at_max,q-100,dpr-2,e-sharpen', 'Display: 6.4-inch FHD+ Super AMOLED display with a 90Hz refresh rate for vibrant colors and smooth visuals.\r\nProcessor: MediaTek Helio G80 processor for efficient performance in gaming and multitasking.\r\nCamera System: Quad-camera setup featuring a 64MP main camera, 8MP ultra-wide lens, 5MP macro lens, and 5MP depth sensor for versatile photography.\r\nFront Camera: 20MP front camera for high-quality selfies and video calls.\r\nBattery: 5000mAh battery with 15W fast charging for all-day usage.\r\nStorage Options: Available in 128GB of internal storage, expandable via microSD card (up to 1TB).\r\nOS: Runs on One UI 3.1 based on Android 11, providing a user-friendly interface and customizable experience.\r\nDesign: Sleek design with a glossy finish and available in multiple color options.\r\nConnectivity: 4G LTE support, Wi-Fi, Bluetooth 5.0, and NFC for enhanced connectivity options.'),
(49, 'Redmi note 13', 'The Redmi Note 13 is an exceptional smartphone that offers a perfect blend of performance, design, and affordability. Featuring a large 6.67-inch FHD+ AMOLED display with a 120Hz refresh rate, it delivers vibrant colors and smooth scrolling for an immersive experience, whether you’re gaming or streaming videos. Powered by a robust MediaTek Dimensity 1080 processor, the device ensures seamless multitasking and efficient performance for everyday tasks. The Redmi Note 13 boasts an impressive triple-camera setup, including a 108MP primary camera, an 8MP ultra-wide lens, and a 2MP macro lens, enabling you to capture stunning photos in any scenario. With its substantial 5000mAh battery, fast charging support, and sleek design, the Redmi Note 13 is designed to keep up with your active lifestyle.', 29999.00, 'redmi', NULL, NULL, 'https://i02.appmifile.com/mi-com-product/fly-birds/redmi-note-13/M/33f308b6070029de2882282a4303a32f.png', 'https://i02.appmifile.com/mi-com-product/fly-birds/redmi-note-13/M/33f308b6070029de2882282a4303a32f.png', 'https://i02.appmifile.com/mi-com-product/fly-birds/redmi-note-13/M/49c74bded5c108dd458cbf51425a26df.png', 'https://i02.appmifile.com/mi-com-product/fly-birds/redmi-note-13/PC/main-camera108mp3.png', 'https://rukminim2.flixcart.com/image/850/1000/xif0q/mobile/8/t/l/-original-imagwzhqxvzmtzft.jpeg?q=90&crop=false', 'Display: 6.67-inch FHD+ AMOLED display with a 120Hz refresh rate for smooth visuals and vibrant colors.\r\nProcessor: MediaTek Dimensity 1080 processor for powerful performance and efficient multitasking.\r\nCamera System: Triple-camera setup with a 108MP main camera, 8MP ultra-wide lens, and 2MP macro lens for versatile photography.\r\nFront Camera: 16MP front camera for high-quality selfies and video conferencing.\r\nBattery: 5000mAh battery with 67W fast charging support for quick power-ups.\r\nStorage Options: Available with up to 256GB of internal storage, expandable via microSD card.\r\nOS: Runs on MIUI 13 based on Android 12, offering a customizable and user-friendly experience.\r\nDesign: Sleek and stylish design with a glass back and available in multiple color options.\r\nConnectivity: 5G support, Wi-Fi 6, Bluetooth 5.2, and NFC for enhanced connectivity.\r\nSecurity: Side-mounted fingerprint sensor for quick and secure unlocking.'),
(50, 'Redmi note 10', 'The Redmi Note 10 Pro is a feature-packed smartphone designed for users who crave a premium experience without breaking the bank. It sports a stunning 6.67-inch FHD+ Super AMOLED display with a 120Hz refresh rate, offering vibrant colors and smooth scrolling for a truly immersive viewing experience. Powered by the Qualcomm Snapdragon 732G processor, the device delivers excellent performance and efficiency for gaming, streaming, and multitasking. The standout feature of the Note 10 Pro is its impressive quad-camera setup, headlined by a 108MP primary sensor that captures stunning detail and clarity in every shot. With a robust 5020mAh battery and 33W fast charging support, the Redmi Note 10 Pro ensures you stay powered up throughout the day.', 39999.00, 'redmi', NULL, NULL, 'https://i01.appmifile.com/webfile/globalimg/products/m/redmi-note-10-pro/green.png', 'https://i01.appmifile.com/webfile/globalimg/products/m/redmi-note-10-pro/green.png', 'https://titaniummobile.net/cdn/shop/products/Note10_3_1024x.png?v=1628133240', 'https://fscl01.fonpit.de/devices/26/2526.png', 'https://rukminim2.flixcart.com/image/850/1000/kmax8y80/mobile/e/i/l/note-10-m2010ghtd1-redmi-original-imagf8hqefstmzc5.jpeg?q=20&crop=false', 'Display: 6.67-inch FHD+ Super AMOLED display with a 120Hz refresh rate for smooth visuals and vibrant colors.\r\nProcessor: Qualcomm Snapdragon 732G processor for powerful performance and efficient multitasking.\r\nCamera System: Quad-camera setup with a 108MP main camera, 8MP ultra-wide lens, 5MP macro lens, and 2MP depth sensor for versatile photography.\r\nFront Camera: 16MP front camera for high-quality selfies and video calls.\r\nBattery: 5020mAh battery with 33W fast charging support for quick power-ups.\r\nStorage Options: Available with up to 128GB of internal storage, expandable via microSD card.\r\nOS: Runs on MIUI 12 based on Android 11, offering a customizable and user-friendly experience.\r\nDesign: Sleek design with a glass back, available in various attractive color options.\r\nConnectivity: Dual SIM support, 4G LTE, Wi-Fi 5, Bluetooth 5.0, and IR blaster for added convenience.\r\n'),
(51, 'Redmi note 12 Pro', 'The Redmi Note 12 Pro is a cutting-edge smartphone that combines powerful performance with an elegant design, catering to users who seek a premium experience at an accessible price. Featuring a large 6.67-inch FHD+ AMOLED display with a 120Hz refresh rate, the device offers stunning visuals and smooth animations, perfect for gaming and streaming content. Powered by the latest MediaTek Dimensity 1080 processor, the Redmi Note 12 Pro ensures seamless multitasking and efficient performance. The impressive triple-camera setup, led by a 108MP main camera, allows users to capture breathtaking photos with exceptional detail and vibrant colors. With a long-lasting 5000mAh battery and 67W fast charging support, this smartphone keeps you connected and productive throughout the day.\r\n\r\n', 49999.00, 'redmi', NULL, NULL, 'https://transform-cf1.nws.ai/https%3A//cdn.thenewsroom.io/platform/story_media/1288797659/843.webp/w_1200,c_limit/', 'https://transform-cf1.nws.ai/https%3A//cdn.thenewsroom.io/platform/story_media/1288797659/843.webp/w_1200,c_limit/', 'https://www.trustedreviews.com/wp-content/uploads/sites/54/2023/03/Redmi-Note-12-Pro-5G-group-2-1024x1024.png', 'https://api.thechennaimobiles.com/Redmi-Note-12-5G-FrostedGreen-1.webp', 'https://rukminim2.flixcart.com/image/850/1000/xif0q/mobile/b/v/y/-original-imaghkvujgvjtf5g.jpeg?q=90&crop=false', 'Display: 6.67-inch FHD+ AMOLED display with a 120Hz refresh rate for fluid visuals and vibrant colors.\r\nProcessor: MediaTek Dimensity 1080 processor for robust performance and efficient power consumption.\r\nCamera System: Triple-camera setup with a 108MP main sensor, 8MP ultra-wide lens, and 2MP macro lens for versatile photography options.\r\nFront Camera: 16MP front camera for high-quality selfies and video conferencing.\r\nBattery: 5000mAh battery with 67W fast charging support, ensuring quick power-ups and all-day usage.\r\nStorage Options: Available with up to 256GB of internal storage, expandable via microSD card.\r\nOS: Runs on MIUI 13 based on Android 12, providing a user-friendly and customizable experience.\r\nDesign: Sleek design with a glass back and a premium finish, available in multiple attractive color variants.\r\nConnectivity: Dual SIM support, 5G compatibility, Wi-Fi 6, Bluetooth 5.2, and an IR blaster for added convenience.\r\nSecurity: Side-mounted fingerprint sensor for quick and secure unlocking.\r\n'),
(52, 'Audio-Technica', 'Sony Wired Headphones offer an immersive audio experience, delivering rich sound quality with clear highs and deep bass. Designed for comfort, these headphones feature plush ear cushions and an adjustable headband, ensuring a snug fit for long listening sessions. With a durable build and a stylish design, they are perfect for music lovers and audiophiles alike. Equipped with a 3.5mm audio jack, these headphones are compatible with a wide range of devices, making them an ideal choice for both casual and professional use. Experience exceptional sound clarity and deep, resonant bass with Sony Wired Headphones.\r\n\r\n', 7000.00, 'wired_headphone', 'https://products.shureweb.eu/shure_product_db/product_main_images/files/c25/16a/40-/original/ce632827adec4e1842caa762f10e643d.webp', NULL, 'https://products.shureweb.eu/shure_product_db/product_main_images/files/c25/16a/40-/original/ce632827adec4e1842caa762f10e643d.webp', 'https://products.shureweb.eu/shure_product_db/product_main_images/files/c25/16a/40-/original/ce632827adec4e1842caa762f10e643d.webp', 'https://foxin.in/cdn/shop/products/WHP_309_1_1080x.png?v=1652958582', 'https://www.thepowercentre.ca/files/image/attachment/60727/WH-ULT900N72.png', 'https://anycallmobilemm.com/wp-content/uploads/2023/05/JBL-Quantum-300-Wired-Headphone-Specs-Photo-2.webp', 'Sound Quality: High-fidelity audio with powerful bass and clear treble for an immersive listening experience.\r\nComfort: Soft ear cushions and adjustable headband for a comfortable fit during extended use.\r\nDurability: Sturdy construction designed to withstand everyday use, ensuring longevity.\r\nConnectivity: Standard 3.5mm audio jack compatible with smartphones, tablets, laptops, and other devices.\r\nLightweight Design: Lightweight build for easy portability, perfect for travel and daily commutes.\r\nInline Remote: Built-in microphone and remote control for hands-free calls and music playback.\r\nStyle: Sleek and modern design available in various colors to suit personal preferences.'),
(53, 'Sony WH-1000XM4 ', 'The Sony WH-1000XM4 is a premium over-ear wireless noise-canceling headphone that can also be used in wired mode. It features advanced noise-canceling technology, high-resolution audio support, and adaptive sound control, providing an exceptional listening experience both wired and wireless. With a sleek design and comfortable fit, it is perfect for long listening sessions.', 9000.00, 'wired_headphone', NULL, NULL, 'https://media.sonos.com/images/znqtjj88/production/bc224536e0b23f1ef5a335336976053a05d6ad8f-2500x2500.png?w=3840&q=100&fit=clip&auto=format', 'https://media.sonos.com/images/znqtjj88/production/bc224536e0b23f1ef5a335336976053a05d6ad8f-2500x2500.png?w=3840&q=100&fit=clip&auto=format', 'https://soniclamb.com/cdn/shop/files/sonic-lamb-over-ear-headhpones-obsidian-black-mode-view.png?v=1710292083&width=1445', 'https://www.avworld.co.nz/wp-content/uploads/WHULT900NW.webp', 'https://images-cdn.ubuy.co.in/667c5f7021be162d327202ed-h3-active-noise-cancelling-headphones.jpg', 'Industry-Leading Noise Cancellation: Advanced noise-canceling technology that adapts to your environment for a distraction-free experience.\r\nHigh-Resolution Audio: Supports LDAC for high-quality audio streaming, ensuring rich and detailed sound.\r\nWired and Wireless Functionality: Can be used wirelessly via Bluetooth or connected with a 3.5mm audio cable for wired listening.\r\nTouch Sensor Controls: Easy-to-use touch controls on the ear cups for playback, volume adjustments, and call management.\r\nSpeak-to-Chat: Automatically pauses playback when you speak and resumes when you stop talking.\r\nAdaptive Sound Control: Adjusts noise-canceling settings based on your activity (traveling, walking, sitting).\r\nLong Battery Life: Up to 30 hours of playback time in wireless mode; quick charging provides up to 5 hours of playback with just a 10-minute charge.\r\nComfortable Fit: Soft ear cushions and lightweight design for long-lasting comfort.\r\nVoice Assistant Integration: Compatible with Google Assistant and Amazon Alexa for hands-free control.'),
(54, 'Skullcandy Riff', 'The Skullcandy Riff Wired Headphones offer a stylish and comfortable listening experience with a lightweight, collapsible design that makes them easy to carry. Featuring refined acoustics, these on-ear headphones deliver clear sound and powerful bass. Ideal for everyday use, the Riff is built with durable materials and comes in various vibrant colors to match your style.', 15000.00, 'wired_headphone', NULL, NULL, 'https://www.skullcandy.com/cdn/shop/files/crusher_anc_2_buy_box_1_preppy-summer_2.png?v=1718646764', 'https://www.skullcandy.com/cdn/shop/files/crusher_anc_2_buy_box_1_preppy-summer_2.png?v=1718646764', 'https://ae01.alicdn.com/kf/Sea6127495aba423f8ea0be645f11189eb.png', 'https://www.skullcandy.eu/cdn/shop/files/crusher_evo_buy_box_nora_1.png?v=1722527437', 'https://xpressouq.com/cdn/shop/files/skullcandy-riff-wireless-headphones-bluespeckle-sunset-xpressouq-4.png?v=1691784830', 'Clear Sound and Powerful Bass: Enhanced acoustics deliver a balanced sound with deep bass, crisp highs, and natural vocals.\r\nDurable and Lightweight Design: Made with tough materials that can handle daily wear and tear while remaining lightweight and comfortable.\r\nComfortable Ear Cushions: Soft ear cushions provide long-lasting comfort, perfect for extended listening sessions.\r\nCollapsible for Easy Portability: The headphones fold flat and compact, making them easy to carry and store.\r\nBuilt-In Microphone and Controls: Integrated mic and call/track control buttons allow you to answer calls, skip tracks, and adjust volume without reaching for your device.\r\nWired Connectivity: Simple plug-and-play with a standard 3.5mm audio jack, compatible with most devices.'),
(55, 'Skullcandy Hesh 3', 'The Skullcandy Hesh 3 Wired Headphones deliver immersive sound quality with a sleek and modern design. These over-ear headphones are crafted for all-day comfort with memory foam ear cushions and an adjustable headband. Known for their deep bass and detailed audio, the Hesh 3 headphones offer a premium listening experience, making them ideal for music lovers who appreciate powerful sound.', 10000.00, 'wired_headphone', NULL, NULL, 'https://www.skullcandy.eu/cdn/shop/files/Hesh_ANC_buy_box_Preppy_1.png?v=1715702669', 'https://www.skullcandy.eu/cdn/shop/files/Hesh_ANC_buy_box_Preppy_1.png?v=1715702669', 'https://www.skullcandy.ca/cdn/shop/files/Hesh_evo_buy_box_TT_Sunset_2_1d8cdb6b-9af3-44a6-a47b-97689a327184.png?v=1712158111&width=1445', 'https://png.pngtree.com/png-clipart/20240525/original/pngtree-beatiful-3d-headphone-in-red-color-png-image_15169049.png', 'https://i5.walmartimages.com/asr/d2b2952f-b778-497f-bd01-3b7592eb2fb2_1.1c5da82363d3495890b5fdcce75c1d35.jpeg', 'Superior Sound Quality: Equipped with high-quality audio drivers, the Hesh 3 provides rich, balanced sound with punchy bass, clear mids, and crisp highs.\r\nComfortable Memory Foam Ear Cushions: Soft, cushioned ear pads and an adjustable headband ensure a snug and comfortable fit for prolonged use.\r\nSturdy and Foldable Design: The headphones are made from durable materials and have a foldable design, making them easy to carry and store.\r\nBuilt-In Microphone and Controls: Features an integrated microphone and on-ear controls for taking calls, adjusting volume, and managing tracks without accessing your device.\r\nWired and Wireless Connectivity Options: While primarily known for their wireless use, they can also be connected via the included 3.5mm audio cable for a wired listening experience.\r\nRapid Charge Technology: Quickly recharge the headphones, providing hours of listening time with just a few minutes of charging (relevant for the wireless mode).'),
(56, 'Apple AirPod Max', 'The Apple AirPods Max are premium over-ear headphones that combine high-fidelity audio with advanced noise cancellation and a sleek, luxurious design. Designed with a custom-built driver, these headphones deliver immersive sound with rich bass, precise mids, and crisp highs. With seamless integration into the Apple ecosystem, AirPods Max offer a personalized listening experience, enhanced by spatial audio and dynamic head tracking that provide a theater-like experience. The memory foam ear cushions and breathable knit mesh canopy ensure comfort for prolonged use, making them ideal for both casual listening and professional use.', 9000.00, 'wireless_headphone', 'https://cdn0.it4profit.com/s3size/rt:fill/w:900/h:900/g:no/el:1/f:webp/plain/s3://cms/product/ec/33/ec33cdbee39528efa369492f0fa31e51/201209150026224233.webp', NULL, 'https://cdn0.it4profit.com/s3size/rt:fill/w:900/h:900/g:no/el:1/f:webp/plain/s3://cms/product/ec/33/ec33cdbee39528efa369492f0fa31e51/201209150026224233.webp', 'https://cdn0.it4profit.com/s3size/rt:fill/w:900/h:900/g:no/el:1/f:webp/plain/s3://cms/product/ec/33/ec33cdbee39528efa369492f0fa31e51/201209150026224233.webp', 'https://cdn0.it4profit.com/s3size/rt:fill/w:900/h:900/g:no/el:1/f:webp/plain/s3://cms/product/b8/5f/b85f682e95e47abc5ed22e782bba17cd/201209150024997196.webp', 'https://thedairy.com/cdn/shop/files/The-Dairy-AirPods-Max-Case-Cover-01-Personalised.png?v=1694019915', 'https://fedtechmagazine.com/sites/fedtechmagazine.com/files/styles/content_body/public/2021-09/FT_Q321_Ps_Soto_Specs.jpg?itok=X7AKrnGE', 'High-Fidelity Audio: Custom drivers provide deep bass, precise mids, and crisp highs for a superior sound experience.\r\nActive Noise Cancellation: Advanced noise-canceling technology blocks out external noise for an immersive listening experience.\r\nTransparency Mode: Switch easily between noise-canceling and hearing your surroundings with a tap.\r\nSpatial Audio with Dynamic Head Tracking: Creates a theater-like sound experience, making you feel surrounded by audio.\r\nAdaptive EQ: Automatically tunes the audio to the fit and seal of the ear cushions.\r\nSeamless Apple Integration: Easy pairing and switching between Apple devices, powered by the H1 chip in each ear cup.\r\nPremium Build Quality: Aluminum ear cups, memory foam ear cushions, and a breathable knit mesh canopy offer durability and comfort.\r\nIntuitive Controls: Digital crown for precise volume control, skipping tracks, and activating Siri.\r\nBattery Life: Up to 20 hours of listening with active noise cancellation and spatial audio enabled.\r\nSmart Case: Puts the AirPods Max in an ultra-low-power state to preserve battery when not in use.'),
(57, 'Skullcandy ANC', 'The Skullcandy Crusher ANC (Active Noise Cancellation) headphones are designed for bass enthusiasts who crave an immersive, customizable sound experience. These over-ear headphones combine adjustable sensory bass, personalized sound tuning, and active noise cancellation to deliver a powerful audio experience tailored to your preferences. With a sleek design, comfortable ear cushions, and robust build quality, the Crusher ANC headphones offer a blend of style, comfort, and advanced features for everyday use or intense listening sessions.\r\n\r\n', 13000.00, 'wireless_headphone', 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6577/6577675ld.png', NULL, 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6577/6577675ld.png', 'https://pisces.bbystatic.com/image2/BestBuy_US/images/products/6577/6577675ld.png', 'https://content.syndigo.com/asset/3ca2c8d0-fa59-404f-ae66-46690f580011/1920.png', 'https://skullcandymalaysia.my/cdn/shop/files/S6HHW-S795_3.png?v=1718851702&width=1500', 'https://rukminim2.flixcart.com/image/850/1000/xif0q/headphone/l/k/z/-original-imagwfuajghr5jcc.jpeg?q=90&crop=false', 'Adjustable Sensory Bass: Unique sensory haptic bass feature allows you to adjust the bass intensity to your liking, providing a truly immersive listening experience.\r\nActive Noise Cancellation: Blocks out unwanted external noise, allowing you to focus solely on your music or calls.\r\nPersonal Sound Tuning: Use the Skullcandy app to create a personalized sound profile tailored to your hearing preferences.\r\nHigh-Quality Audio: Custom-tuned drivers deliver clear vocals, deep bass, and crisp highs for balanced sound across all genres.\r\nRapid Charge Technology: Quick charging provides 3 hours of playback with just a 10-minute charge, and up to 24 hours of battery life on a full charge.\r\nBuilt-In Tile Tracker: Integrated Tile technology helps you locate your headphones if they are misplaced.\r\nComfortable Design: Soft ear cushions and an adjustable headband ensure comfort during long listening sessions.\r\nIntuitive Controls: Easy-to-use buttons on the earcups for controlling volume, changing tracks, and managing calls.\r\nFoldable and Portable: The foldable design makes them easy to carry and store in the provided travel case.\r\nVoice Assistant Compatibility: Supports voice assistants like Google Assistant and Siri for hands-free control.');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `image_url`, `page_url`, `main_image_url`, `sub_image1_url`, `sub_image2_url`, `sub_image3_url`, `sub_image4_url`, `key_features`) VALUES
(58, 'Jabra Elite 85h', 'The Jabra Elite 85h are premium over-ear wireless headphones designed for superior sound, exceptional comfort, and smart noise cancellation. Engineered for music lovers and professionals on the go, these headphones offer personalized sound, impressive battery life, and AI-driven SmartSound technology that adapts to your environment for an optimal listening experience. The Elite 85h features a stylish, durable design with water and dust resistance, making them a perfect choice for everyday use in any setting.', 12000.00, 'wireless_headphone', NULL, NULL, 'https://5.imimg.com/data5/AJ/CN/PW/SELLER-81636235/jabra-elite-85h-calls-and-music-wireless-headset.png', 'https://5.imimg.com/data5/AJ/CN/PW/SELLER-81636235/jabra-elite-85h-calls-and-music-wireless-headset.png', 'https://ogo1.ru/upload/iblock/026/026db5a26d408f1e8b1463184c915394.png', 'https://ogo1.ru/upload/iblock/85f/85fac5d5c9552c17a5ee1fc51e30302b.png', 'https://www.vplak.com/500-images/jabra/ELITE-85H/copper-black/image-6.jpg', 'Smart Active Noise Cancellation (ANC): Automatically adapts to your surroundings to block out unwanted noise, allowing for a seamless listening experience.\r\nSmartSound Technology: Uses AI to analyze your sound environment and adjust your audio settings in real time for the best sound quality.\r\nPersonalized Audio: Customizable sound profiles through the Jabra Sound+ app, tailoring the sound to your preferences.\r\nCrystal-Clear Calls: Equipped with 8 microphones that enhance call quality by reducing wind and background noise, ensuring clear conversations.\r\nLong Battery Life: Offers up to 36 hours of battery life with ANC on, and up to 41 hours without ANC, with fast charging that provides 5 hours of use from just a 15-minute charge.\r\nVoice Assistant Integration: Compatible with Alexa, Siri, and Google Assistant for hands-free control and easy access to your phone’s assistant.\r\nComfortable, Stylish Design: Soft memory foam ear cushions and a flexible headband ensure a snug fit, making them comfortable to wear for extended periods.\r\nWater and Dust Resistant: Certified with IP52 rating, offering protection against dust and light rain, making them durable for daily use.\r\nOn-Ear Detection: Automatically pauses music when you take off the headphones and resumes playback when you put them back on.\r\nMulti-Device Connectivity: Connects seamlessly with two devices simultaneously, allowing you to switch between calls and music effortlessly.'),
(59, 'Bang & Olufsen', 'The Bang & Olufsen Beoplay H9 are premium wireless over-ear headphones crafted for those who appreciate high-quality sound, luxurious materials, and advanced features. Known for their rich, immersive sound profile and active noise cancellation, the Beoplay H9 combines elegant Scandinavian design with comfort and performance. These headphones are ideal for audiophiles and frequent travelers seeking a sophisticated listening experience with intuitive controls and extended battery life.', 14000.00, 'wireless_headphone', 'https://www.onlineplayshop.nl/cdn/shop/products/file_deba4faa-e425-4f0a-8014-c8691adbf841.png?v=1691592732', NULL, 'https://www.onlineplayshop.nl/cdn/shop/products/file_deba4faa-e425-4f0a-8014-c8691adbf841.png?v=1691592732', 'https://www.onlineplayshop.nl/cdn/shop/products/file_deba4faa-e425-4f0a-8014-c8691adbf841.png?v=1691592732', 'https://images.macrumors.com/t/kdg17U1tV3-Nv6GbKglhXyWuKlk=/1600x0/article-new/2017/02/H4_charcoal_470x600.png', 'https://images.ctfassets.net/8cd2csgvqd3m/2qXFy9fvLO42c91y1IoR78/5d788e5817f357c8c6469e3384826b6a/h9-peonyhero-1000x1000.png', 'https://cdn.headphonecheck.com/wp-content/uploads/BangOlufsen-Beoplay-HX-5-1920x1080.jpg', 'Premium Sound Quality: Features Bang & Olufsen’s signature sound, delivering a balanced audio experience with deep bass, clear mids, and crisp highs.\r\nActive Noise Cancellation (ANC): Effectively reduces ambient noise, allowing you to enjoy your music, podcasts, or calls without distractions.\r\nLuxurious Design: Crafted with high-quality materials, including anodized aluminum, soft lambskin leather, and memory foam ear cushions for a comfortable and luxurious feel.\r\nTouch Controls: Intuitive touch-sensitive controls on the ear cups allow you to easily adjust volume, change tracks, and manage calls with simple gestures.\r\nLong Battery Life: Offers up to 25 hours of playtime with Bluetooth and ANC on, ensuring you stay connected to your music throughout the day.\r\nTransparency Mode: Quickly switch to hear your surroundings without removing the headphones, perfect for brief conversations or listening to announcements.\r\nVoice Assistant Integration: Compatible with voice assistants like Google Assistant and Siri, enabling hands-free control of your music and calls.\r\nReplaceable Battery: Unique for modern headphones, the battery can be replaced, extending the overall lifespan of the headphones.\r\nComfortable Fit: The over-ear design with plush memory foam ear cushions ensures a snug fit, providing excellent passive noise isolation and all-day comfort.\r\nDurable and Portable: Foldable design with a sturdy carrying case makes them easy to store and travel with, ensuring they stay protected when not in use.');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `slide_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image_url`, `caption`, `slide_order`) VALUES
(13, 'https://edifier-online.com/cdn/shop/files/g2bt_a2556f15-6473-4244-9ab3-4c2ec90664ef.png?v=1709537608&width=1100', 'Music listening: Enjoying music from a device or streaming service.', 2),
(15, 'https://inventstore.in/wp-content/uploads/2023/04/iPhone_13_Midnight_.webp', 'The iPhone is a line of smartphones designed by Apple that combines cutting-edge technology with user-friendly design. ', 1),
(16, 'https://www.imagineonline.store/cdn/shop/products/MV7N2HN_A_1.png?v=1634188830&width=823', 'AirPods are wireless earbuds developed by Apple, offering a seamless audio experience with Apple\'s ecosystem. Have Some fun ! ', 4),
(22, 'https://images.samsung.com/is/image/samsung/p6pim/in/2401/gallery/in-galaxy-s24-s928-492660-sm-s928bzoqins-539573852', 'Samsung is taking the lead in building artificial intelligence into mobile devices. Introduced in the Galaxy S24 Series, Galaxy AI provides a suite of new tools to enhance productivity, streamline communication, and simplify digital interactions.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `subscribed_at`) VALUES
(1, 'f@gmail.com', '2024-09-28 09:18:49'),
(2, 'abcd@gmail.com', '2024-09-28 09:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_date` datetime DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `contact_method` varchar(20) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT 0,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `address`, `phone`, `password`, `login_date`, `full_name`, `dob`, `gender`, `contact_method`, `newsletter`, `profile_picture`) VALUES
(14, 'firos', 'firos@gmail.com', '', '', '$2y$10$BU/rOqnsOmFgD1ZxB2q4R.UQlTohD55hvB5F7Tq1hTFwvnVRnk28u', NULL, NULL, NULL, NULL, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
