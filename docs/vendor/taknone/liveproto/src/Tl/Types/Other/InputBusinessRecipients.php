<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true existing_chats true new_chats true contacts true non_contacts true exclude_selected Vector<InputUser> users
 * @return InputBusinessRecipients
 */

final class InputBusinessRecipients extends Instance {
	public function request(? true $existing_chats = null,? true $new_chats = null,? true $contacts = null,? true $non_contacts = null,? true $exclude_selected = null,? array $users = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6f8b32aa);
		$flags = 0;
		$flags |= is_null($existing_chats) ? 0 : (1 << 0);
		$flags |= is_null($new_chats) ? 0 : (1 << 1);
		$flags |= is_null($contacts) ? 0 : (1 << 2);
		$flags |= is_null($non_contacts) ? 0 : (1 << 3);
		$flags |= is_null($exclude_selected) ? 0 : (1 << 5);
		$flags |= is_null($users) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		if(is_null($users) === false):
			$writer->tgwriteVector($users,'InputUser');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['existing_chats'] = true;
		else:
			$result['existing_chats'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['new_chats'] = true;
		else:
			$result['new_chats'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['contacts'] = true;
		else:
			$result['contacts'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['non_contacts'] = true;
		else:
			$result['non_contacts'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['exclude_selected'] = true;
		else:
			$result['exclude_selected'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['users'] = $reader->tgreadVector('InputUser');
		else:
			$result['users'] = null;
		endif;
		return new self($result);
	}
}

?>