<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string endpoint Vector<GroupCallParticipantVideoSourceGroup> source_groups true paused int audio_source
 * @return GroupCallParticipantVideo
 */

final class GroupCallParticipantVideo extends Instance {
	public function request(string $endpoint,array $source_groups,? true $paused = null,? int $audio_source = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x67753ac8);
		$flags = 0;
		$flags |= is_null($paused) ? 0 : (1 << 0);
		$flags |= is_null($audio_source) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($endpoint);
		$writer->tgwriteVector($source_groups,'GroupCallParticipantVideoSourceGroup');
		if(is_null($audio_source) === false):
			$writer->writeInt($audio_source);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['paused'] = true;
		else:
			$result['paused'] = false;
		endif;
		$result['endpoint'] = $reader->tgreadBytes();
		$result['source_groups'] = $reader->tgreadVector('GroupCallParticipantVideoSourceGroup');
		if($flags & (1 << 1)):
			$result['audio_source'] = $reader->readInt();
		else:
			$result['audio_source'] = null;
		endif;
		return new self($result);
	}
}

?>