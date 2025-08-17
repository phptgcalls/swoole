<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int duration true voice string title string performer bytes waveform
 * @return DocumentAttribute
 */

final class DocumentAttributeAudio extends Instance {
	public function request(int $duration,? true $voice = null,? string $title = null,? string $performer = null,? string $waveform = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9852f9c6);
		$flags = 0;
		$flags |= is_null($voice) ? 0 : (1 << 10);
		$flags |= is_null($title) ? 0 : (1 << 0);
		$flags |= is_null($performer) ? 0 : (1 << 1);
		$flags |= is_null($waveform) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeInt($duration);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($performer) === false):
			$writer->tgwriteBytes($performer);
		endif;
		if(is_null($waveform) === false):
			$writer->tgwriteBytes($waveform);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 10)):
			$result['voice'] = true;
		else:
			$result['voice'] = false;
		endif;
		$result['duration'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['performer'] = $reader->tgreadBytes();
		else:
			$result['performer'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['waveform'] = $reader->tgreadBytes();
		else:
			$result['waveform'] = null;
		endif;
		return new self($result);
	}
}

?>