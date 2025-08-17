<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true reply true read_messages true delete_sent_messages true delete_received_messages true edit_name true edit_bio true edit_profile_photo true edit_username true view_gifts true sell_gifts true change_gift_settings true transfer_and_upgrade_gifts true transfer_stars true manage_stories
 * @return BusinessBotRights
 */

final class BusinessBotRights extends Instance {
	public function request(? true $reply = null,? true $read_messages = null,? true $delete_sent_messages = null,? true $delete_received_messages = null,? true $edit_name = null,? true $edit_bio = null,? true $edit_profile_photo = null,? true $edit_username = null,? true $view_gifts = null,? true $sell_gifts = null,? true $change_gift_settings = null,? true $transfer_and_upgrade_gifts = null,? true $transfer_stars = null,? true $manage_stories = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa0624cf7);
		$flags = 0;
		$flags |= is_null($reply) ? 0 : (1 << 0);
		$flags |= is_null($read_messages) ? 0 : (1 << 1);
		$flags |= is_null($delete_sent_messages) ? 0 : (1 << 2);
		$flags |= is_null($delete_received_messages) ? 0 : (1 << 3);
		$flags |= is_null($edit_name) ? 0 : (1 << 4);
		$flags |= is_null($edit_bio) ? 0 : (1 << 5);
		$flags |= is_null($edit_profile_photo) ? 0 : (1 << 6);
		$flags |= is_null($edit_username) ? 0 : (1 << 7);
		$flags |= is_null($view_gifts) ? 0 : (1 << 8);
		$flags |= is_null($sell_gifts) ? 0 : (1 << 9);
		$flags |= is_null($change_gift_settings) ? 0 : (1 << 10);
		$flags |= is_null($transfer_and_upgrade_gifts) ? 0 : (1 << 11);
		$flags |= is_null($transfer_stars) ? 0 : (1 << 12);
		$flags |= is_null($manage_stories) ? 0 : (1 << 13);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['reply'] = true;
		else:
			$result['reply'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['read_messages'] = true;
		else:
			$result['read_messages'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['delete_sent_messages'] = true;
		else:
			$result['delete_sent_messages'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['delete_received_messages'] = true;
		else:
			$result['delete_received_messages'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['edit_name'] = true;
		else:
			$result['edit_name'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['edit_bio'] = true;
		else:
			$result['edit_bio'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['edit_profile_photo'] = true;
		else:
			$result['edit_profile_photo'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['edit_username'] = true;
		else:
			$result['edit_username'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['view_gifts'] = true;
		else:
			$result['view_gifts'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['sell_gifts'] = true;
		else:
			$result['sell_gifts'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['change_gift_settings'] = true;
		else:
			$result['change_gift_settings'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['transfer_and_upgrade_gifts'] = true;
		else:
			$result['transfer_and_upgrade_gifts'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['transfer_stars'] = true;
		else:
			$result['transfer_stars'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['manage_stories'] = true;
		else:
			$result['manage_stories'] = false;
		endif;
		return new self($result);
	}
}

?>