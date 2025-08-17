<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes random_id string url string title string message string button_text true recommended true can_report Vector<MessageEntity> entities photo photo messagemedia media peercolor color string sponsor_info string additional_info int min_display_duration int max_display_duration
 * @return SponsoredMessage
 */

final class SponsoredMessage extends Instance {
	public function request(string $random_id,string $url,string $title,string $message,string $button_text,? true $recommended = null,? true $can_report = null,? array $entities = null,? object $photo = null,? object $media = null,? object $color = null,? string $sponsor_info = null,? string $additional_info = null,? int $min_display_duration = null,? int $max_display_duration = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7dbf8673);
		$flags = 0;
		$flags |= is_null($recommended) ? 0 : (1 << 5);
		$flags |= is_null($can_report) ? 0 : (1 << 12);
		$flags |= is_null($entities) ? 0 : (1 << 1);
		$flags |= is_null($photo) ? 0 : (1 << 6);
		$flags |= is_null($media) ? 0 : (1 << 14);
		$flags |= is_null($color) ? 0 : (1 << 13);
		$flags |= is_null($sponsor_info) ? 0 : (1 << 7);
		$flags |= is_null($additional_info) ? 0 : (1 << 8);
		$flags |= is_null($min_display_duration) ? 0 : (1 << 15);
		$flags |= is_null($max_display_duration) ? 0 : (1 << 15);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($random_id);
		$writer->tgwriteBytes($url);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		if(is_null($media) === false):
			$writer->write($media->read());
		endif;
		if(is_null($color) === false):
			$writer->write($color->read());
		endif;
		$writer->tgwriteBytes($button_text);
		if(is_null($sponsor_info) === false):
			$writer->tgwriteBytes($sponsor_info);
		endif;
		if(is_null($additional_info) === false):
			$writer->tgwriteBytes($additional_info);
		endif;
		if(is_null($min_display_duration) === false):
			$writer->writeInt($min_display_duration);
		endif;
		if(is_null($max_display_duration) === false):
			$writer->writeInt($max_display_duration);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 5)):
			$result['recommended'] = true;
		else:
			$result['recommended'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['can_report'] = true;
		else:
			$result['can_report'] = false;
		endif;
		$result['random_id'] = $reader->tgreadBytes();
		$result['url'] = $reader->tgreadBytes();
		$result['title'] = $reader->tgreadBytes();
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['media'] = $reader->tgreadObject();
		else:
			$result['media'] = null;
		endif;
		if($flags & (1 << 13)):
			$result['color'] = $reader->tgreadObject();
		else:
			$result['color'] = null;
		endif;
		$result['button_text'] = $reader->tgreadBytes();
		if($flags & (1 << 7)):
			$result['sponsor_info'] = $reader->tgreadBytes();
		else:
			$result['sponsor_info'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['additional_info'] = $reader->tgreadBytes();
		else:
			$result['additional_info'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['min_display_duration'] = $reader->readInt();
		else:
			$result['min_display_duration'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['max_display_duration'] = $reader->readInt();
		else:
			$result['max_display_duration'] = null;
		endif;
		return new self($result);
	}
}

?>