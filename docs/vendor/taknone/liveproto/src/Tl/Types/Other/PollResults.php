<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true min Vector<PollAnswerVoters> results int total_voters Vector<Peer> recent_voters string solution Vector<MessageEntity> solution_entities
 * @return PollResults
 */

final class PollResults extends Instance {
	public function request(? true $min = null,? array $results = null,? int $total_voters = null,? array $recent_voters = null,? string $solution = null,? array $solution_entities = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7adf2420);
		$flags = 0;
		$flags |= is_null($min) ? 0 : (1 << 0);
		$flags |= is_null($results) ? 0 : (1 << 1);
		$flags |= is_null($total_voters) ? 0 : (1 << 2);
		$flags |= is_null($recent_voters) ? 0 : (1 << 3);
		$flags |= is_null($solution) ? 0 : (1 << 4);
		$flags |= is_null($solution_entities) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		if(is_null($results) === false):
			$writer->tgwriteVector($results,'PollAnswerVoters');
		endif;
		if(is_null($total_voters) === false):
			$writer->writeInt($total_voters);
		endif;
		if(is_null($recent_voters) === false):
			$writer->tgwriteVector($recent_voters,'Peer');
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
		if($flags & (1 << 0)):
			$result['min'] = true;
		else:
			$result['min'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['results'] = $reader->tgreadVector('PollAnswerVoters');
		else:
			$result['results'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['total_voters'] = $reader->readInt();
		else:
			$result['total_voters'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['recent_voters'] = $reader->tgreadVector('Peer');
		else:
			$result['recent_voters'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['solution'] = $reader->tgreadBytes();
		else:
			$result['solution'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['solution_entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['solution_entities'] = null;
		endif;
		return new self($result);
	}
}

?>