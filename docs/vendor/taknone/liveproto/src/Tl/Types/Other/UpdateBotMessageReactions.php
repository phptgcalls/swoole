<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int msg_id int date Vector<ReactionCount> reactions int qts
 * @return Update
 */

final class UpdateBotMessageReactions extends Instance {
	public function request(object $peer,int $msg_id,int $date,array $reactions,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9cb7759);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->writeInt($date);
		$writer->tgwriteVector($reactions,'ReactionCount');
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['reactions'] = $reader->tgreadVector('ReactionCount');
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>