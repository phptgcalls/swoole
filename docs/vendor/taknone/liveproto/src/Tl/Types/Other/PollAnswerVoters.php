<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes option int voters true chosen true correct
 * @return PollAnswerVoters
 */

final class PollAnswerVoters extends Instance {
	public function request(string $option,int $voters,? true $chosen = null,? true $correct = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3b6ddad2);
		$flags = 0;
		$flags |= is_null($chosen) ? 0 : (1 << 0);
		$flags |= is_null($correct) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($option);
		$writer->writeInt($voters);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['chosen'] = true;
		else:
			$result['chosen'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['correct'] = true;
		else:
			$result['correct'] = false;
		endif;
		$result['option'] = $reader->tgreadBytes();
		$result['voters'] = $reader->readInt();
		return new self($result);
	}
}

?>