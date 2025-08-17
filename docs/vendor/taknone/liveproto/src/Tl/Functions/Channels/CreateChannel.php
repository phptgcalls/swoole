<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title string about true broadcast true megagroup true for_import true forum inputgeopoint geo_point string address int ttl_period
 * @return Updates
 */

final class CreateChannel extends Instance {
	public function request(string $title,string $about,? true $broadcast = null,? true $megagroup = null,? true $for_import = null,? true $forum = null,? object $geo_point = null,? string $address = null,? int $ttl_period = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x91006707);
		$flags = 0;
		$flags |= is_null($broadcast) ? 0 : (1 << 0);
		$flags |= is_null($megagroup) ? 0 : (1 << 1);
		$flags |= is_null($for_import) ? 0 : (1 << 3);
		$flags |= is_null($forum) ? 0 : (1 << 5);
		$flags |= is_null($geo_point) ? 0 : (1 << 2);
		$flags |= is_null($address) ? 0 : (1 << 2);
		$flags |= is_null($ttl_period) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($about);
		if(is_null($geo_point) === false):
			$writer->write($geo_point->read());
		endif;
		if(is_null($address) === false):
			$writer->tgwriteBytes($address);
		endif;
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
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