<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id int date true requested true via_chatlist string about long approved_by
 * @return ChatInviteImporter
 */

final class ChatInviteImporter extends Instance {
	public function request(int $user_id,int $date,? true $requested = null,? true $via_chatlist = null,? string $about = null,? int $approved_by = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8c5adfd9);
		$flags = 0;
		$flags |= is_null($requested) ? 0 : (1 << 0);
		$flags |= is_null($via_chatlist) ? 0 : (1 << 3);
		$flags |= is_null($about) ? 0 : (1 << 2);
		$flags |= is_null($approved_by) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($user_id);
		$writer->writeInt($date);
		if(is_null($about) === false):
			$writer->tgwriteBytes($about);
		endif;
		if(is_null($approved_by) === false):
			$writer->writeLong($approved_by);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['requested'] = true;
		else:
			$result['requested'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['via_chatlist'] = true;
		else:
			$result['via_chatlist'] = false;
		endif;
		$result['user_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 2)):
			$result['about'] = $reader->tgreadBytes();
		else:
			$result['about'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['approved_by'] = $reader->readLong();
		else:
			$result['approved_by'] = null;
		endif;
		return new self($result);
	}
}

?>