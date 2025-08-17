<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call long time_ms int scale int video_channel int video_quality
 * @return InputFileLocation
 */

final class InputGroupCallStream extends Instance {
	public function request(object $call,int $time_ms,int $scale,? int $video_channel = null,? int $video_quality = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x598a92a);
		$flags = 0;
		$flags |= is_null($video_channel) ? 0 : (1 << 0);
		$flags |= is_null($video_quality) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($call->read());
		$writer->writeLong($time_ms);
		$writer->writeInt($scale);
		if(is_null($video_channel) === false):
			$writer->writeInt($video_channel);
		endif;
		if(is_null($video_quality) === false):
			$writer->writeInt($video_quality);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['call'] = $reader->tgreadObject();
		$result['time_ms'] = $reader->readLong();
		$result['scale'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['video_channel'] = $reader->readInt();
		else:
			$result['video_channel'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['video_quality'] = $reader->readInt();
		else:
			$result['video_quality'] = null;
		endif;
		return new self($result);
	}
}

?>