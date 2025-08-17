<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true change_info true post_messages true edit_messages true delete_messages true ban_users true invite_users true pin_messages true add_admins true anonymous true manage_call true other true manage_topics true post_stories true edit_stories true delete_stories true manage_direct_messages
 * @return ChatAdminRights
 */

final class ChatAdminRights extends Instance {
	public function request(? true $change_info = null,? true $post_messages = null,? true $edit_messages = null,? true $delete_messages = null,? true $ban_users = null,? true $invite_users = null,? true $pin_messages = null,? true $add_admins = null,? true $anonymous = null,? true $manage_call = null,? true $other = null,? true $manage_topics = null,? true $post_stories = null,? true $edit_stories = null,? true $delete_stories = null,? true $manage_direct_messages = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5fb224d5);
		$flags = 0;
		$flags |= is_null($change_info) ? 0 : (1 << 0);
		$flags |= is_null($post_messages) ? 0 : (1 << 1);
		$flags |= is_null($edit_messages) ? 0 : (1 << 2);
		$flags |= is_null($delete_messages) ? 0 : (1 << 3);
		$flags |= is_null($ban_users) ? 0 : (1 << 4);
		$flags |= is_null($invite_users) ? 0 : (1 << 5);
		$flags |= is_null($pin_messages) ? 0 : (1 << 7);
		$flags |= is_null($add_admins) ? 0 : (1 << 9);
		$flags |= is_null($anonymous) ? 0 : (1 << 10);
		$flags |= is_null($manage_call) ? 0 : (1 << 11);
		$flags |= is_null($other) ? 0 : (1 << 12);
		$flags |= is_null($manage_topics) ? 0 : (1 << 13);
		$flags |= is_null($post_stories) ? 0 : (1 << 14);
		$flags |= is_null($edit_stories) ? 0 : (1 << 15);
		$flags |= is_null($delete_stories) ? 0 : (1 << 16);
		$flags |= is_null($manage_direct_messages) ? 0 : (1 << 17);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['change_info'] = true;
		else:
			$result['change_info'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['post_messages'] = true;
		else:
			$result['post_messages'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['edit_messages'] = true;
		else:
			$result['edit_messages'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['delete_messages'] = true;
		else:
			$result['delete_messages'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['ban_users'] = true;
		else:
			$result['ban_users'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['invite_users'] = true;
		else:
			$result['invite_users'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['pin_messages'] = true;
		else:
			$result['pin_messages'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['add_admins'] = true;
		else:
			$result['add_admins'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['anonymous'] = true;
		else:
			$result['anonymous'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['manage_call'] = true;
		else:
			$result['manage_call'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['other'] = true;
		else:
			$result['other'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['manage_topics'] = true;
		else:
			$result['manage_topics'] = false;
		endif;
		if($flags & (1 << 14)):
			$result['post_stories'] = true;
		else:
			$result['post_stories'] = false;
		endif;
		if($flags & (1 << 15)):
			$result['edit_stories'] = true;
		else:
			$result['edit_stories'] = false;
		endif;
		if($flags & (1 << 16)):
			$result['delete_stories'] = true;
		else:
			$result['delete_stories'] = false;
		endif;
		if($flags & (1 << 17)):
			$result['manage_direct_messages'] = true;
		else:
			$result['manage_direct_messages'] = false;
		endif;
		return new self($result);
	}
}

?>