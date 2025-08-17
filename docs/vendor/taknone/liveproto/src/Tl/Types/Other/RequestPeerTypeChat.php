<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true creator true bot_participant bool has_username bool forum chatadminrights user_admin_rights chatadminrights bot_admin_rights
 * @return RequestPeerType
 */

final class RequestPeerTypeChat extends Instance {
	public function request(? true $creator = null,? true $bot_participant = null,? bool $has_username = null,? bool $forum = null,? object $user_admin_rights = null,? object $bot_admin_rights = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc9f06e1b);
		$flags = 0;
		$flags |= is_null($creator) ? 0 : (1 << 0);
		$flags |= is_null($bot_participant) ? 0 : (1 << 5);
		$flags |= is_null($has_username) ? 0 : (1 << 3);
		$flags |= is_null($forum) ? 0 : (1 << 4);
		$flags |= is_null($user_admin_rights) ? 0 : (1 << 1);
		$flags |= is_null($bot_admin_rights) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($has_username) === false):
			$writer->tgwriteBool($has_username);
		endif;
		if(is_null($forum) === false):
			$writer->tgwriteBool($forum);
		endif;
		if(is_null($user_admin_rights) === false):
			$writer->write($user_admin_rights->read());
		endif;
		if(is_null($bot_admin_rights) === false):
			$writer->write($bot_admin_rights->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['creator'] = true;
		else:
			$result['creator'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['bot_participant'] = true;
		else:
			$result['bot_participant'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['has_username'] = $reader->tgreadBool();
		else:
			$result['has_username'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['forum'] = $reader->tgreadBool();
		else:
			$result['forum'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['user_admin_rights'] = $reader->tgreadObject();
		else:
			$result['user_admin_rights'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['bot_admin_rights'] = $reader->tgreadObject();
		else:
			$result['bot_admin_rights'] = null;
		endif;
		return new self($result);
	}
}

?>