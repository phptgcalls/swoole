<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id chatadminrights admin_rights string rank
 * @return ChannelParticipant
 */

final class ChannelParticipantCreator extends Instance {
	public function request(int $user_id,object $admin_rights,? string $rank = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2fe601d3);
		$flags = 0;
		$flags |= is_null($rank) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($user_id);
		$writer->write($admin_rights->read());
		if(is_null($rank) === false):
			$writer->tgwriteBytes($rank);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['user_id'] = $reader->readLong();
		$result['admin_rights'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['rank'] = $reader->tgreadBytes();
		else:
			$result['rank'] = null;
		endif;
		return new self($result);
	}
}

?>