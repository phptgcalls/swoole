<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id textwithentities question Vector<PollAnswer> answers true closed true public_voters true multiple_choice true quiz int close_period int close_date
 * @return Poll
 */

final class Poll extends Instance {
	public function request(int $id,object $question,array $answers,? true $closed = null,? true $public_voters = null,? true $multiple_choice = null,? true $quiz = null,? int $close_period = null,? int $close_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x58747131);
		$writer->writeLong($id);
		$flags = 0;
		$flags |= is_null($closed) ? 0 : (1 << 0);
		$flags |= is_null($public_voters) ? 0 : (1 << 1);
		$flags |= is_null($multiple_choice) ? 0 : (1 << 2);
		$flags |= is_null($quiz) ? 0 : (1 << 3);
		$flags |= is_null($close_period) ? 0 : (1 << 4);
		$flags |= is_null($close_date) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->write($question->read());
		$writer->tgwriteVector($answers,'PollAnswer');
		if(is_null($close_period) === false):
			$writer->writeInt($close_period);
		endif;
		if(is_null($close_date) === false):
			$writer->writeInt($close_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['closed'] = true;
		else:
			$result['closed'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['public_voters'] = true;
		else:
			$result['public_voters'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['multiple_choice'] = true;
		else:
			$result['multiple_choice'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['quiz'] = true;
		else:
			$result['quiz'] = false;
		endif;
		$result['question'] = $reader->tgreadObject();
		$result['answers'] = $reader->tgreadVector('PollAnswer');
		if($flags & (1 << 4)):
			$result['close_period'] = $reader->readInt();
		else:
			$result['close_period'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['close_date'] = $reader->readInt();
		else:
			$result['close_date'] = null;
		endif;
		return new self($result);
	}
}

?>