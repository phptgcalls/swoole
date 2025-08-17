<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id inputmedia media Vector<MediaArea> media_areas string caption Vector<MessageEntity> entities Vector<InputPrivacyRule> privacy_rules
 * @return Updates
 */

final class EditStory extends Instance {
	public function request(object $peer,int $id,? object $media = null,? array $media_areas = null,? string $caption = null,? array $entities = null,? array $privacy_rules = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb583ba46);
		$flags = 0;
		$flags |= is_null($media) ? 0 : (1 << 0);
		$flags |= is_null($media_areas) ? 0 : (1 << 3);
		$flags |= is_null($caption) ? 0 : (1 << 1);
		$flags |= is_null($entities) ? 0 : (1 << 1);
		$flags |= is_null($privacy_rules) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($id);
		if(is_null($media) === false):
			$writer->write($media->read());
		endif;
		if(is_null($media_areas) === false):
			$writer->tgwriteVector($media_areas,'MediaArea');
		endif;
		if(is_null($caption) === false):
			$writer->tgwriteBytes($caption);
		endif;
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($privacy_rules) === false):
			$writer->tgwriteVector($privacy_rules,'InputPrivacyRule');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>