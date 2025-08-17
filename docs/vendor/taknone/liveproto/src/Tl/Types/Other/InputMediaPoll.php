<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param poll poll Vector<bytes> correct_answers string solution Vector<MessageEntity> solution_entities
 * @return InputMedia
 */

final class InputMediaPoll extends Instance {
	public function request(object $poll,? array $correct_answers = null,? string $solution = null,? array $solution_entities = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf94e5f1);
		$flags = 0;
		$flags |= is_null($correct_answers) ? 0 : (1 << 0);
		$flags |= is_null($solution) ? 0 : (1 << 1);
		$flags |= is_null($solution_entities) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($poll->read());
		if(is_null($correct_answers) === false):
			$writer->tgwriteVector($correct_answers,'bytes');
		endif;
		if(is_null($solution) === false):
			$writer->tgwriteBytes($solution);
		endif;
		if(is_null($solution_entities) === false):
			$writer->tgwriteVector($solution_entities,'MessageEntity');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['poll'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['correct_answers'] = $reader->tgreadVector('bytes');
		else:
			$result['correct_answers'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['solution'] = $reader->tgreadBytes();
		else:
			$result['solution'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['solution_entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['solution_entities'] = null;
		endif;
		return new self($result);
	}
}

?>