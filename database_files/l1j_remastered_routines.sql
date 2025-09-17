
DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_DEATH_PENALTY_24_HOUR` ()   BEGIN
	DELETE FROM character_death_exp WHERE delete_time <= NOW();
	DELETE FROM character_death_item WHERE delete_time <= NOW();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LOCK_CHECKER` ()   BEGIN
	SELECT straight_join 
		w.trx_mysql_thread_id waiting_thread, 
		w.trx_id waiting_trx_id,
		w.trx_query waiting_query,
		 b.trx_mysql_thread_id blocking_thread,
    		 b.trx_id blocking_trx_id,
		b.trx_query blocking_query,
		bl.lock_id blocking_lock_id,
		bl.lock_mode blocking_lock_mode,
		bl.lock_type blocking_lock_type,
		bl.lock_table blocking_lock_table,
		bl.lock_index blocking_lock_index,
		wl.lock_id waiting_lock_id,
		wl.lock_mode waiting_lock_mode,
		wl.lock_type waiting_lock_type,
		wl.lock_table waiting_lock_table,
		wl.lock_index waiting_lock_index
	FROM 
		information_schema.INNODB_LOCK_WAITS ilw, 
		information_schema.INNODB_TRX b, 
		information_schema.INNODB_TRX w, 
		information_schema.INNODB_LOCKS bl, 
		information_schema.INNODB_LOCKS wl 
	WHERE 
		b.trx_id = ilw.blocking_trx_id 
		AND w.trx_id = ilw.requesting_trx_id 
		AND bl.lock_id = ilw.blocking_lock_id 
		AND wl.lock_id = ilw.requested_lock_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PLEDGE_RENEWAL_INIT` ()   BEGIN
	UPDATE characters SET ClanRank=8 WHERE ClanRank > 0 AND ClanRank <> 10;
	UPDATE characters SET pledgeJoinDate=1679595656 WHERE ClanID > 0 AND pledgeJoinDate = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RESET_DAILY` ()   BEGIN

	UPDATE attendance_accounts SET dailyCount=0, isCompleted='false', resetDate=NOW();

	UPDATE character_hunting_quest SET kill_count=0, complete='false';

	UPDATE accounts_free_buff_shield A SET pccafe_favor_remain_count=3, pccafe_reward_item_count=0, reset_time=NOW(), 
		free_favor_remain_count = (
			CASE 
				(SELECT COUNT(B.TamEndTime) 
					FROM characters B 
						WHERE B.account_name = A.account_name 
							AND B.TamEndTime IS NOT NULL 
							AND (
									(B.TamEndTime > NOW()) 
									OR 
									(DATE_ADD(B.TamEndTime, INTERVAL (SELECT SUM(C.day) FROM character_arca C WHERE C.charId = B.objid) DAY) > NOW())
							)
				)
				WHEN 5 THEN 2
				WHEN 4 THEN 2
				WHEN 3 THEN 2
				WHEN 2 THEN 1
				WHEN 1 THEN 1
				ELSE 0
			END
	);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RESET_WEEKLY` ()   BEGIN

	UPDATE accounts SET Shop_open_count=0;

	UPDATE characters SET ClanWeekContribution=0;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SERVER_RESET` ()   BEGIN
	DELETE FROM accounts;
	DELETE FROM accounts_shop_limit;
	DELETE FROM accounts_free_buff_shield;
	DELETE FROM accounts_pcmaster_golden;
	DELETE FROM attendance_accounts;
	DELETE FROM character_buddys;
	DELETE FROM character_buff;
	DELETE FROM character_companion;
	DELETE FROM character_companion_buff;
	DELETE FROM character_config;
	DELETE FROM character_death_exp;
	DELETE FROM character_death_item;
	DELETE FROM character_einhasadstat;
	DELETE FROM character_elf_warehouse;
	DELETE FROM character_exclude;
	DELETE FROM character_fairly_config;
	DELETE FROM character_hunting_quest;
	DELETE FROM character_items;
	DELETE FROM character_monsterbooklist;
	DELETE FROM character_package_warehouse;
	DELETE FROM character_present_warehouse;
	DELETE FROM character_beginner_quest;
	DELETE FROM character_quests;
	DELETE FROM character_skills_active;
	DELETE FROM character_skills_passive;
	DELETE FROM character_equipset;
	DELETE FROM character_shop_limit;
	DELETE FROM character_soldier;
	DELETE FROM character_special_warehouse;
	DELETE FROM character_revenge;
	DELETE FROM character_eventpush;
	DELETE FROM character_teleport;
	DELETE FROM character_warehouse;
	DELETE FROM character_arca;
	DELETE FROM character_favorbook;
	DELETE FROM character_timecollection;
	DELETE FROM character_einhasadfaith;
	DELETE FROM characters;
	DELETE FROM clan_data WHERE clan_id NOT IN (1, 2, 3, 4, 289340076);
	DELETE FROM clan_contribution_buff;
	DELETE FROM clan_joinning;
	DELETE FROM clan_warehouse;
	DELETE FROM clan_history;
	DELETE FROM clan_warehouse_list;
	DELETE FROM clan_warehouse_log;
	DELETE FROM craft_success_count_user;
	DELETE FROM dungeon_timer_account;
	DELETE FROM dungeon_timer_character;
	DELETE FROM letter;
	DELETE FROM letter_spam;
	DELETE FROM dogfight_tickets;
	DELETE FROM race_tickets;
	DELETE FROM marble;
	DELETE FROM report;
	DELETE FROM tj_coupon;
	DELETE FROM ub_rank;
	DELETE FROM board_user;
	DELETE FROM board_user1;
	DELETE FROM log_adena_monster;
	DELETE FROM log_adena_shop;
	DELETE FROM log_chat;
	DELETE FROM log_cwarehouse;
	DELETE FROM log_enchant;
	DELETE FROM log_private_shop;
	DELETE FROM log_shop;
	DELETE FROM log_warehouse;
	UPDATE castle SET public_money = 0;
	UPDATE house SET is_on_sale = 1, is_purchase_basement = 0, tax_deadline = NOW();
	UPDATE board_auction SET deadline = NOW(), old_owner = '', old_owner_id = 0, bidder = '', bidder_id = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SHOP_BUY_LIMIT_USER_INIT` ()   BEGIN
	DELETE FROM accounts_shop_limit WHERE (limitTerm='DAY' AND buyTime NOT BETWEEN DATE_ADD(NOW(), INTERVAL -1 DAY) AND buyTime) OR (limitTerm='WEEK' AND buyTime NOT BETWEEN DATE_ADD(NOW(), INTERVAL -1 WEEK) AND buyTime);
	DELETE FROM character_shop_limit WHERE (limitTerm='DAY' AND buyTime NOT BETWEEN DATE_ADD(NOW(), INTERVAL -1 DAY) AND buyTime) OR (limitTerm='WEEK' AND buyTime NOT BETWEEN DATE_ADD(NOW(), INTERVAL -1 WEEK) AND buyTime);
END$$

DELIMITER ;
