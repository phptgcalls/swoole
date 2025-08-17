<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string connection_id peer peer Vector<int> messages int qts
 * @return Update
 */

final class UpdateBotDeleteBusinessMessage extends Instance {
	public function request(string $connection_id,object $peer,array $messages,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa02a982e);
		$writer->tgwriteBytes($connection_id);
		$writer->write($peer->read());
		$writer->tgwriteVector($messages,'int');
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['connection_id'] = $reader->tgreadBytes();
		$result['peer'] = $reader->tgreadObject();
		$result['messages'] = $reader->tgreadVector('int');
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>