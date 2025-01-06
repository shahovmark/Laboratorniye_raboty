

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, '1', '$2y$10$OKEsSUhtxgVwmMTw4R8LFONOFgOMJ.gPQpZYtzE1XM9j6ECCwY/2y', 'admin', '2024-12-08 10:56:13'),
(2, 'artemchik68', '$2y$10$GEXk9pLE.KxH7FYvg4ahSeTH14mU.4Qe.S9gtc3mnKba8lG.6VYhS', 'user', '2024-12-08 10:58:08'),
(3, '2', '$2y$10$WD.lqj6rxo6z5tL9nzNt/.XS2ACX.lZ9iEfv1PLLM6xxjVnSdVKtO', 'user', '2024-12-08 10:58:23');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
