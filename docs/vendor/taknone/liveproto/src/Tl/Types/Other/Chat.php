<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string title chatphoto photo int participants_count int date int version true creator true left true deactivated true call_active true call_not_empty true noforwards inputchannel migrated_to chatadminrights admin_rights chatbannedrights default_banned_rights
 * @return Chat
 */

final class Chat extends Instance {
	public function request(int $id,string $title,object $photo,int $participants_count,int $date,int $version,? true $creator = null,? true $left = null,? true $deactivated = null,? true $call_active = null,? true $call_not_empty = null,? true $noforwards = null,? object $migrated_to = null,? object $admin_rights = null,? object $default_banned_rights = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x41cbf256);
		$flags = 0;
		$flags |= is_null($creator) ? 0 : (1 << 0);
		$flags |= is_null($left) ? 0 : (1 << 2);
		$flags |= is_null($deactivated) ? 0 : (1 << 5);
		$flags |= is_null($call_active) ? 0 : (1 << 23);
		$flags |= is_null($call_not_empty) ? 0 : (1 << 24);
		$flags |= is_null($noforwards) ? 0 : (1 << 25);
		$flags |= is_null($migrated_to) ? 0 : (1 << 6);
		$flags |= is_null($admin_rights) ? 0 : (1 << 14);
		$flags |= is_null($default_banned_rights) ? 0 : (1 << 18);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->tgwriteBytes($title);
		$writer->write($photo->read());
		$writer->writeInt($participants_count);
		$writer->writeInt($date);
		$writer->writeInt($version);
		if(is_null($migrated_to) === false):
			$writer->write($migrated_to->read());
		endif;
		if(is_null($admin_rights) === false):
			$writer->write($admin_rights->read());
		endif;
		if(is_null($default_banned_rights) === false):
			$writer->write($default_banned_rights->read());
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
		if($flags & (1 << 2)):
			$result['left'] = true;
		else:
			$result['left'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['deactivated'] = true;
		else:
			$result['deactivated'] = false;
		endif;
		if($flags & (1 << 23)):
			$result['call_active'] = true;
		else:
			$result['call_active'] = false;
		endif;
		if($flags & (1 << 24)):
			$result['call_not_empty'] = true;
		else:
			$result['call_not_empty'] = false;
		endif;
		if($flags & (1 << 25)):
			$result['noforwards'] = true;
		else:
			$result['noforwards'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		$result['photo'] = $reader->tgreadObject();
		$result['participants_count'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['version'] = $reader->readInt();
		if($flags & (1 << 6)):
			$result['migrated_to'] = $reader->tgreadObject();
		else:
			$result['migrated_to'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['admin_rights'] = $reader->tgreadObject();
		else:
			$result['admin_rights'] = null;
		endif;
		if($flags & (1 << 18)):
			$result['default_banned_rights'] = $reader->tgreadObject();
		else:
			$result['default_banned_rights'] = null;
		endif;
		return new self($result);
	}
}

?>