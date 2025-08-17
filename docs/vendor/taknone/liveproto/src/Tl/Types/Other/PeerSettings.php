<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true report_spam true add_contact true block_contact true share_contact true need_contacts_exception true report_geo true autoarchived true invite_members true request_chat_broadcast true business_bot_paused true business_bot_can_reply int geo_distance string request_chat_title int request_chat_date long business_bot_id string business_bot_manage_url long charge_paid_message_stars string registration_month string phone_country int name_change_date int photo_change_date
 * @return PeerSettings
 */

final class PeerSettings extends Instance {
	public function request(? true $report_spam = null,? true $add_contact = null,? true $block_contact = null,? true $share_contact = null,? true $need_contacts_exception = null,? true $report_geo = null,? true $autoarchived = null,? true $invite_members = null,? true $request_chat_broadcast = null,? true $business_bot_paused = null,? true $business_bot_can_reply = null,? int $geo_distance = null,? string $request_chat_title = null,? int $request_chat_date = null,? int $business_bot_id = null,? string $business_bot_manage_url = null,? int $charge_paid_message_stars = null,? string $registration_month = null,? string $phone_country = null,? int $name_change_date = null,? int $photo_change_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf47741f7);
		$flags = 0;
		$flags |= is_null($report_spam) ? 0 : (1 << 0);
		$flags |= is_null($add_contact) ? 0 : (1 << 1);
		$flags |= is_null($block_contact) ? 0 : (1 << 2);
		$flags |= is_null($share_contact) ? 0 : (1 << 3);
		$flags |= is_null($need_contacts_exception) ? 0 : (1 << 4);
		$flags |= is_null($report_geo) ? 0 : (1 << 5);
		$flags |= is_null($autoarchived) ? 0 : (1 << 7);
		$flags |= is_null($invite_members) ? 0 : (1 << 8);
		$flags |= is_null($request_chat_broadcast) ? 0 : (1 << 10);
		$flags |= is_null($business_bot_paused) ? 0 : (1 << 11);
		$flags |= is_null($business_bot_can_reply) ? 0 : (1 << 12);
		$flags |= is_null($geo_distance) ? 0 : (1 << 6);
		$flags |= is_null($request_chat_title) ? 0 : (1 << 9);
		$flags |= is_null($request_chat_date) ? 0 : (1 << 9);
		$flags |= is_null($business_bot_id) ? 0 : (1 << 13);
		$flags |= is_null($business_bot_manage_url) ? 0 : (1 << 13);
		$flags |= is_null($charge_paid_message_stars) ? 0 : (1 << 14);
		$flags |= is_null($registration_month) ? 0 : (1 << 15);
		$flags |= is_null($phone_country) ? 0 : (1 << 16);
		$flags |= is_null($name_change_date) ? 0 : (1 << 17);
		$flags |= is_null($photo_change_date) ? 0 : (1 << 18);
		$writer->writeInt($flags);
		if(is_null($geo_distance) === false):
			$writer->writeInt($geo_distance);
		endif;
		if(is_null($request_chat_title) === false):
			$writer->tgwriteBytes($request_chat_title);
		endif;
		if(is_null($request_chat_date) === false):
			$writer->writeInt($request_chat_date);
		endif;
		if(is_null($business_bot_id) === false):
			$writer->writeLong($business_bot_id);
		endif;
		if(is_null($business_bot_manage_url) === false):
			$writer->tgwriteBytes($business_bot_manage_url);
		endif;
		if(is_null($charge_paid_message_stars) === false):
			$writer->writeLong($charge_paid_message_stars);
		endif;
		if(is_null($registration_month) === false):
			$writer->tgwriteBytes($registration_month);
		endif;
		if(is_null($phone_country) === false):
			$writer->tgwriteBytes($phone_country);
		endif;
		if(is_null($name_change_date) === false):
			$writer->writeInt($name_change_date);
		endif;
		if(is_null($photo_change_date) === false):
			$writer->writeInt($photo_change_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['report_spam'] = true;
		else:
			$result['report_spam'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['add_contact'] = true;
		else:
			$result['add_contact'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['block_contact'] = true;
		else:
			$result['block_contact'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['share_contact'] = true;
		else:
			$result['share_contact'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['need_contacts_exception'] = true;
		else:
			$result['need_contacts_exception'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['report_geo'] = true;
		else:
			$result['report_geo'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['autoarchived'] = true;
		else:
			$result['autoarchived'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['invite_members'] = true;
		else:
			$result['invite_members'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['request_chat_broadcast'] = true;
		else:
			$result['request_chat_broadcast'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['business_bot_paused'] = true;
		else:
			$result['business_bot_paused'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['business_bot_can_reply'] = true;
		else:
			$result['business_bot_can_reply'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['geo_distance'] = $reader->readInt();
		else:
			$result['geo_distance'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['request_chat_title'] = $reader->tgreadBytes();
		else:
			$result['request_chat_title'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['request_chat_date'] = $reader->readInt();
		else:
			$result['request_chat_date'] = null;
		endif;
		if($flags & (1 << 13)):
			$result['business_bot_id'] = $reader->readLong();
		else:
			$result['business_bot_id'] = null;
		endif;
		if($flags & (1 << 13)):
			$result['business_bot_manage_url'] = $reader->tgreadBytes();
		else:
			$result['business_bot_manage_url'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['charge_paid_message_stars'] = $reader->readLong();
		else:
			$result['charge_paid_message_stars'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['registration_month'] = $reader->tgreadBytes();
		else:
			$result['registration_month'] = null;
		endif;
		if($flags & (1 << 16)):
			$result['phone_country'] = $reader->tgreadBytes();
		else:
			$result['phone_country'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['name_change_date'] = $reader->readInt();
		else:
			$result['name_change_date'] = null;
		endif;
		if($flags & (1 << 18)):
			$result['photo_change_date'] = $reader->readInt();
		else:
			$result['photo_change_date'] = null;
		endif;
		return new self($result);
	}
}

?>