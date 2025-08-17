<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer long kicked_by int date chatbannedrights banned_rights true left
 * @return ChannelParticipant
 */

final class ChannelParticipantBanned extends Instance {
	public function request(object $peer,int $kicked_by,int $date,object $banned_rights,? true $left = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6df8014e);
		$flags = 0;
		$flags |= is_null($left) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeLong($kicked_by);
		$writer->writeInt($date);
		$writer->write($banned_rights->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['left'] = true;
		else:
			$result['left'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		$result['kicked_by'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['banned_rights'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>