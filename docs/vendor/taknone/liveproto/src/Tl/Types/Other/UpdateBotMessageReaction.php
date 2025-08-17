<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int msg_id int date peer actor Vector<Reaction> old_reactions Vector<Reaction> new_reactions int qts
 * @return Update
 */

final class UpdateBotMessageReaction extends Instance {
	public function request(object $peer,int $msg_id,int $date,object $actor,array $old_reactions,array $new_reactions,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xac21d3ce);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->writeInt($date);
		$writer->write($actor->read());
		$writer->tgwriteVector($old_reactions,'Reaction');
		$writer->tgwriteVector($new_reactions,'Reaction');
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['actor'] = $reader->tgreadObject();
		$result['old_reactions'] = $reader->tgreadVector('Reaction');
		$result['new_reactions'] = $reader->tgreadVector('Reaction');
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>